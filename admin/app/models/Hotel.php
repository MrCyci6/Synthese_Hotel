<?php

    require_once '../app/models/Database.php';

    class Hotel {

        static function getHotels() {
            $statement = Database::preparedQuery(
                "SELECT h.id_hotel, h.nom as nom_hotel, cl.denomination as classe FROM hotel h
                INNER JOIN classe cl ON cl.id_classe=h.id_classe;",
                []
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT h.id_hotel, h.nom as nom_hotel, cl.denomination as classe FROM hotel h
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE h.id_hotel=?;",
                [$hotelId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getSales(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COALESCE(SUM((r.date_fin - r.date_debut) * pc.prix), 0) + COALESCE(SUM(cc.nombre * pc2.prix), 0) AS ca FROM Hotel h
                LEFT JOIN Chambre c ON h.id_hotel = c.id_hotel
                LEFT JOIN Categorie cat ON c.id_categorie = cat.id_categorie
                LEFT JOIN Prix_chambre pc ON pc.id_classe = h.id_classe AND pc.id_categorie = c.id_categorie
                LEFT JOIN Reservation r ON c.id_chambre = r.id_chambre
                LEFT JOIN Conso_client cc ON r.id_sejour = cc.id_sejour
                LEFT JOIN Prix_conso pc2 ON cc.id_conso = pc2.id_conso AND h.id_hotel = pc2.id_hotel
                WHERE h.id_hotel=?
                GROUP BY h.nom, h.id_hotel;",
                [$hotelId]
            );
            return $statement->fetch()['ca'];
        }

        static function getOccupedRoomsCount(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(r.id_chambre) as count FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre = r.id_chambre
                WHERE NOW() BETWEEN r.date_debut AND r.date_fin AND ch.id_hotel = ?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }

        static function getRoomsCount(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(id_chambre) FROM chambre WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }
    }

?>