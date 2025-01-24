<?php

    require_once 'models/Database.php';

    class Logs {

        static function getLogs(int $start = -1, int $end = -1) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe ".
                ($start == -1 || $end == -1) ? "" : " WHERE l.id_log BETWEEN ? AND ?",
                ($start == -1 || $end == -1) ? [] : [$start, $end]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getLog(int $logId) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE l.id_log=?;",
                [$logId]
            );
            $results = $statement->fetch();
            return $results;
        }

        static function getLogsByUser(int $userId) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE l.id_user=?;",
                [$userId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getLogsByHotel(int $hotelId, string $filters) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE l.id_hotel=? ".$filters.";",
                [$hotelId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getLogsByUserAndHotel(int $userId, int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE l.id_user=? AND l.id_hotel=?;",
                [$userId, $hotelId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

?>