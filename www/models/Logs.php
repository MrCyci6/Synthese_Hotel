<?php

    require_once '../models/Database.php';

    class Logs {

        static function addLog(int $userId, int $hotelId, string $content) {
            Database::preparedQuery(
                "INSERT INTO logs(id_user, id_hotel, content, date) VALUES (?, ?, ?, NOW());",
                [$userId, $hotelId, $content]
            );
        }

        static function getLogs(int $hotelId, int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe 
                WHERE h.id_hotel=?
                ORDER BY l.id_log DESC
                LIMIT ? OFFSET ?;",
                [$hotelId, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function searchLogs(string $data, int $hotelId, int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe 
                WHERE h.id_hotel=? AND
                    (
                        LOWER(u.nom) LIKE LOWER('%' || ? || '%')
                        OR LOWER(u.prenom) LIKE LOWER('%' || ? || '%')
                        OR LOWER(l.content) LIKE LOWER('%' || ? || '%')
                        OR CAST(l.date as varchar) LIKE '%' || ? || '%'
                    )
                ORDER BY l.id_log DESC
                LIMIT ? OFFSET ?;",
                [$hotelId, $data, $data, $data, $data, $limit, ($page-1)*$limit]
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

        static function getLogsByUser(int $userId, string $filter = "") {
            $statement = Database::preparedQuery(
                "SELECT l.id_log, l.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, l.id_hotel, h.nom as nom_hotel, cl.denomination as classe, l.content, l.date FROM logs l
                INNER JOIN users u ON u.id_user=l.id_user
                INNER JOIN hotel h ON h.id_hotel=l.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE l.id_user=? ".$filter.";",
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