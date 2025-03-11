<?php

    require_once 'models/Database.php';

    class Reservation {

        static function getReservations(int $hotelId, int $start = -1, int $end = -1) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, ca.denomination as categorie, u.nom as nom_user, u.prenom as prenom_user, h.id_classe, pc.prix, r.date_debut, r.date_fin, (r.date_fin-r.date_debut)*pc.prix as total, NOW() as now FROM reservation r
                INNER JOIN chambre c ON c.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=c.id_hotel
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=c.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN categorie ca ON ca.id_categorie=c.id_categorie
                WHERE h.id_hotel=? ".
                (($start == -1 || $end == -1) ? "" : "AND r.id_sejour BETWEEN ? AND ?"),
                ($start == -1 || $end == -1) ? [$hotelId] : [$hotelId, $start, $end]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservation(int $reservationId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.id_categorie, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, (r.date_fin-r.date_debut)*pc.prix as total, paiement, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=ca.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE r.id_sejour=?;",
                [$reservationId]
            );
            $results = $statement->fetch();
            return $results;
        }

        static function searchReservation($data) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE email_user=? OR nom_user=? OR prenom_user=? OR classe=?;",
                [$data, $data, $data, $data]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservationsByUser(int $userId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE r.id_user=?;",
                [$userId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservationsByHotel(int $hotelId, string $filters = "") {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE h.id_hotel=? ".
                $filters.";",
                [$hotelId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservationsCountByHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(r.id_sejour) as count FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                WHERE ch.id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }

        static function getReservationsByHotelAndUser(int $hotelId, int $userId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE h.id_hotel=? AND r.id_user=?;",
                [$hotelId, $userId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function deleteReservation(int $bookId) {
            Database::preparedQuery("DELETE FROM reservation WHERE id_sejour=?", [$bookId]);
        }

        static function getCategories() {
            $statement = Database::preparedQuery(
                "SELECT id_categorie, denomination as categorie FROM categorie;",
                []
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

?>