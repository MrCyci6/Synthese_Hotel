<?php

    require_once 'models/Database.php';

    class Conso {
        
        static function getListConsos(){
            $statement = Database::preparedQuery("SELECT * FROM conso;", array());
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getConsoAndPrice(int $hotelId = -1) {
            $query = "SELECT  conso.denomination,prix_conso.id_conso as id,conso.id_conso,id_hotel,prix from prix_conso
                        join conso on conso.id_conso=prix_conso.id_conso
                        WHERE id_hotel = :id_hotel";
            $statement = Database::preparedQuery($query, ($hotelId==-1 ? [] : [$hotelId]));
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }

        static function getConsos(int $hotelId, int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT  cc.id_cc, cc.id_conso, c.denomination as conso, cc.id_sejour, r.id_user, u.nom as nom_user, u.prenom as prenom_user, ch.numero_chambre, h.id_hotel, h.nom as hotel, cl.denomination as classe, cc.date_conso, cc.nombre, pc.prix as prix_unit,pc.prix*cc.nombre as prix FROM conso_client cc
                INNER JOIN conso c ON c.id_conso=cc.id_conso
                INNER JOIN reservation r ON r.id_sejour=cc.id_sejour
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                INNER JOIN prix_conso pc ON pc.id_conso=cc.id_conso AND pc.id_hotel=h.id_hotel
                WHERE h.id_hotel=?
                ORDER BY cc.id_cc DESC
                LIMIT ? OFFSET ?;",
                [$hotelId, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function searchConsos(string $data, int $hotelId, int $limit, $page) {
            $statement = Database::preparedQuery(
                "SELECT  cc.id_cc, cc.id_conso, c.denomination as conso, cc.id_sejour, r.id_user, u.nom as nom_user, u.prenom as prenom_user, ch.numero_chambre, h.id_hotel, h.nom as hotel, cl.denomination as classe, cc.date_conso, cc.nombre, pc.prix as prix_unit, pc.prix*cc.nombre as prix FROM conso_client cc
                INNER JOIN conso c ON c.id_conso=cc.id_conso
                INNER JOIN reservation r ON r.id_sejour=cc.id_sejour
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                INNER JOIN prix_conso pc ON pc.id_conso=cc.id_conso AND pc.id_hotel=h.id_hotel

                WHERE h.id_hotel=? AND 
                    (LOWER(u.email) LIKE LOWER('%' || ? || '%') 
                    OR LOWER(u.nom) LIKE LOWER('%' || ? || '%') 
                    OR LOWER(u.prenom) LIKE LOWER('%' || ? || '%') 
                    OR CAST(pc.prix as varchar) LIKE '%' || ? || '%'
                    OR CAST(pc.prix*cc.nombre as varchar) LIKE '%' || ? || '%'
                    OR CAST(cc.date_conso as varchar) LIKE '%' || ? || '%'
                    OR CAST(cc.id_sejour as varchar) LIKE '%' || ? || '%'
                    OR CAST(cc.nombre as varchar) LIKE '%' || ? || '%'
                    OR CAST(ch.numero_chambre as varchar) LIKE '%' || ? || '%'
                    OR LOWER(c.denomination) LIKE LOWER('%' || ? || '%'))

                    ORDER BY cc.id_cc DESC
                    LIMIT ? OFFSET ?;", 
                [$hotelId, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getConso(int $consoId, int $hotelId = -1) {
            $statement = Database::preparedQuery(
                "SELECT cc.id_cc, cc.id_conso, c.denomination as conso, cc.id_sejour, r.id_user, u.nom as nom_user, u.prenom as prenom_user, ch.numero_chambre, h.id_hotel, h.nom as hotel, cl.denomination as classe, cc.date_conso, cc.nombre, pc.prix*cc.nombre as prix FROM conso_client cc
                INNER JOIN conso c ON c.id_conso=cc.id_conso
                INNER JOIN reservation r ON r.id_sejour=cc.id_sejour
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                INNER JOIN prix_conso pc ON pc.id_conso=cc.id_conso AND pc.id_hotel=h.id_hotel
                WHERE pc.id_conso=? ".($hotelId==-1 ? "" : "AND h.id_hotel=?").";", 
                ($hotelId==-1 ? [$consoId] : [$consoId, $hotelId])
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getConsosCount(int $hotelId = -1) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(cc.id_cc) as count FROM conso_client cc
                INNER JOIN reservation r ON r.id_sejour=cc.id_sejour
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre ".
                ($hotelId==-1 ? "" : "WHERE ch.id_hotel=?").";", 
                ($hotelId==-1 ? [] : [$hotelId])
            );
            return $statement->fetch()['count'];
        }


        static function AjoutConsoClient($sejour,$id_conso,$quantite){
            $stmt=Database::preparedQuery(
                "INSERT INTO conso_client (id_conso, id_sejour, nombre, date_conso) VALUES (:id_conso, :id_sejour, :nombre, :date_conso)",
                array(":id_conso"=>$id_conso,':id_sejour'=>$sejour,":nombre"=>$quantite,":date_conso"=>date("Y-m-d"))
            );
        }

        static function ajoutConso($nom, $prix, int $hotelId = -1) {
            $query = "INSERT INTO Conso (denomination) VALUES (:nom) RETURNING id_conso";
            $statement = Database::preparedQuery($query, array(':nom'=>$nom));
            $id_conso = $statement->fetchColumn();

            $query2="INSERT INTO Prix_conso (id_hotel, id_conso, prix) VALUES (:id_hotel, :id_conso, :prix)";
            $statement2 = Database::preparedQuery($query2, array(':id_hotel'=>$hotelId, ':id_conso'=>$id_conso, ':prix'=>$prix));
        }

        static function ajoutConsoExistante($id_conso,$prix,int $hotelId = -1) {
            $query2="INSERT INTO Prix_conso (id_hotel, id_conso, prix) VALUES (:id_hotel, :id_conso, :prix)";
            $statement2 = Database::preparedQuery($query2, array(':id_hotel'=>$hotelId, ':id_conso'=>$id_conso, ':prix'=>$prix));
        }
        static function ConsoNonPresente(int $hotelId = -1) {
            $statement = Database::preparedQuery(
                "SELECT c.id_conso, c.denomination
                        FROM Conso c
                        LEFT JOIN prix_conso pc ON c.id_conso = pc.id_conso AND pc.id_hotel = :id_hotel
                        WHERE pc.id_conso IS NULL;",array(':id_hotel'=>$hotelId));
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function ModifPrice($new_price,$id_conso,$hotel_id){
            $stmt = Database::preparedQuery(
                "UPDATE prix_conso SET prix = :new_price WHERE id_conso = :id_conso and id_hotel=:id_hotel;",
                        array(":id_conso"=>$id_conso,':new_price'=>$new_price,":id_hotel"=>$hotel_id));
        }
    }
?>