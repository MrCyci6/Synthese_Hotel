<?php

    require_once '../app/models/Database.php';

    class Conso {

        static function getConsos(int $hotelId = -1, string $filters = "") {
            $statement = Database::preparedQuery(
                "SELECT cc.id_cc, cc.id_conso, c.denomination as conso, cc.id_sejour, r.id_user, u.nom as nom_user, u.prenom as prenom_user, ch.numero_chambre, h.id_hotel, h.nom as hotel, cl.denomination as classe, cc.date_conso, cc.nombre, pc.prix*cc.nombre as prix FROM conso_client cc
                INNER JOIN conso c ON c.id_conso=cc.id_conso
                INNER JOIN reservation r ON r.id_sejour=cc.id_sejour
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                INNER JOIN prix_conso pc ON pc.id_conso=cc.id_conso AND pc.id_hotel=h.id_hotel ".
                ($hotelId==-1 ? "" : "WHERE h.id_hotel=?")." ".$filters.";", 
                ($hotelId==-1 ? [] : [$hotelId])
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
    }

?>