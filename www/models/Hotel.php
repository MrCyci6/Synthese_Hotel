<?php

    require_once '../models/Database.php';

    class Hotel {

        static function getHotels() {
            $statement = Database::preparedQuery(
                "SELECT h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, MIN(prix_ch.prix) AS prix_min, h.localisation FROM hotel h
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                LEFT JOIN chambre ch ON ch.id_hotel = h.id_hotel
                LEFT JOIN prix_chambre prix_ch ON ch.id_categorie = prix_ch.id_categorie
                GROUP BY h.id_hotel, h.nom, h.localisation, cl.denomination
                ORDER BY h.nom;",
                []
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        	/**
         * Récupère la catégorie d'un hôtel à partir de son identifiant.
         *
         * @param int $id_hotel L'id de l'hôtel.
         * @return string|null La catégorie ou null si non trouvée.
         */
        public static function getHotelCategory(int $id_hotel): ?string {
            $query = "SELECT cl.denomination AS categorie 
                    FROM hotel h 
                    JOIN classe cl ON h.id_classe = cl.id_classe 
                    WHERE h.id_hotel = :id_hotel";
            $stmt = Database::preparedQuery($query, [':id_hotel' => $id_hotel]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['categorie'] : null;
        }

        static function getHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, h.localisation FROM hotel h
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

        public static function getAvailableRooms(int $hotelId, string $dateDebut, string $dateFin): array {
            $query = "SELECT c.id_chambre
                  FROM chambre c
                  WHERE c.id_hotel = :id_hotel
                  AND c.id_chambre NOT IN (
                      SELECT r.id_chambre FROM reservation r
                      WHERE r.date_debut <= :dateFin AND r.date_fin >= :dateDebut
                  )";
            $params = [
                ':id_hotel' => $hotelId,
                ':dateDebut' => $dateDebut,
                ':dateFin' => $dateFin
            ];
            $stmt = Database::preparedQuery($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        static function getRoomsCount(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(id_chambre) FROM chambre WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }


        public static function getHotelId() : array {
            $query = "SELECT nom, id_hotel as id FROM hotel;";
            $stmt = Database::preparedQuery($query, []);
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        }
    
        public static function getServices(): array {
            $query = "SELECT id_service, nom, description, image_url 
                  FROM services 
                  ORDER BY nom";
            $stmt = Database::preparedQuery($query, []);
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        }

    }

?>