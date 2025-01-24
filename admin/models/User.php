<?php

    require_once 'models/Database.php';

    class User {

        static function getUsers(int $start = -1, int $end = -1) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users ".
                ($start == -1 || $end == -1) ? "" : " WHERE id_user BETWEEN ? AND ?",
                ($start == -1 || $end == -1) ? [] : [$start, $end]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getUser(int $id) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users 
                WHERE id_user=?",
                [$id]
            );
            $user = $statement->fetch();
            return $user;
        }

        static function searchUser(string $data) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users
                WHERE nom=? OR prenom=? OR email=?",
                [$data, $data, $data]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

?>