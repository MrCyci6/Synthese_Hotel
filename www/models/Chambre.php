<?php

    require_once '../models/Database.php';

    class Chambre {

        public static function getRoomInfos(int $id_hotel, string $date_arrive, string $date_depart): array {
            $query = "SELECT cc.denomination AS categorie_nom, pc.prix, COUNT(ch.id_chambre) AS chambres_disponibles
                      FROM chambre ch
                      JOIN categorie cc ON ch.id_categorie = cc.id_categorie
                      JOIN prix_chambre pc ON ch.id_categorie = pc.id_categorie
                      WHERE ch.id_hotel = :id_hotel
                      AND ch.id_chambre NOT IN (
                          SELECT id_chambre FROM reservation 
                          WHERE date_debut <= :date_depart 
                          AND date_fin >= :date_arrive
                      )
                      GROUP BY cc.denomination, pc.prix
                      ORDER BY pc.prix";
            $params = [
                'id_hotel' => $id_hotel,
                'date_arrive' => $date_arrive,
                'date_depart' => $date_depart
            ];
            $stmt = Database::preparedQuery($query, $params);
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        }
    
        public static function createReservation(int $hotel_id, string $categorie, float $prix, string $date_arrive, string $date_depart, int $id_user): ?int {
            // Sélectionner une chambre disponible
            $query = "SELECT ch.id_chambre
                      FROM chambre ch
                      JOIN categorie cc ON ch.id_categorie = cc.id_categorie
                      JOIN prix_chambre pc ON ch.id_categorie = pc.id_categorie
                      WHERE ch.id_hotel = :hotel_id
                      AND cc.denomination = :categorie
                      AND pc.prix = :prix
                      AND ch.id_chambre NOT IN (
                          SELECT id_chambre FROM reservation 
                          WHERE date_debut <= :date_depart 
                          AND date_fin >= :date_arrive
                      )
                      LIMIT 1";
            $params = [
                'hotel_id' => $hotel_id,
                'categorie' => $categorie,
                'prix' => $prix,
                'date_arrive' => $date_arrive,
                'date_depart' => $date_depart
            ];
            $stmt = Database::preparedQuery($query, $params);
            $chambre = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    
            if (!$chambre) {
                return null;
            }
    
            // Insérer la réservation
            $query = "INSERT INTO reservation (id_chambre, id_user, date_debut, date_fin, date_arrivee, paiement)
                      VALUES (:id_chambre, :id_user, :date_debut, :date_fin, :date_arrivee, :paiement)";
            $params = [
                'id_chambre' => $chambre['id_chambre'],
                'id_user' => $id_user,
                'date_debut' => $date_arrive,
                'date_fin' => $date_depart,
                'date_arrivee' => $date_arrive,
                'paiement' => 0
            ];
            $stmt = Database::preparedQuery($query, $params);
    
            if ($stmt) {
                return Database::lastInsertId();
            }
            return null;
        }

        static function getRoomsCountByHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(id_chambre) FROM chambre WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }

        static function getRoomsInfo(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT distinct categorie.denomination as chambre,categorie.id_categorie as cate,hotel.id_hotel as id, prix_chambre.prix as prix, hotel.id_classe FROM hotel
                JOIN chambre using(id_hotel)
                JOIN categorie using(id_categorie)
                JOIN prix_chambre on hotel.id_classe=prix_chambre.id_classe and chambre.id_categorie=prix_chambre.id_categorie
                WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        static function modifyPrice($categorie, $classe, $prix) {
            $statement = Database::preparedQuery(
                "UPDATE prix_chambre SET prix=? where id_classe=? and id_categorie=?;", 
                [$prix, $categorie, $classe]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>