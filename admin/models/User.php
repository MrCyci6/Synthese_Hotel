<?php

    require_once 'models/Database.php';

    class User {

        static function updateUser(int $userId, string $nom, string $prenom, string $email, string $addresse, string $password = "") {
            Database::preparedQuery(
                "UPDATE users SET 
                nom=?, prenom=?, addresse=?, email=?".
                ($password == "" ? " " : ", hash=crypt(?, gen_salt('bf')) ").
                "WHERE id_user=?",
                ($pasword == "" ? [$nom, $prenom, $addresse, $email, $userId] : [$nom, $prenom, $addresse, $email, $password, $userId])
            );
        }

        static function loginUser(string $email, string $password) {
            $statement = Database::preparedQuery(
                "SELECT id_user FROM users WHERE email=? AND hash=crypt(?, hash);",
                [$email, $password]
            );
            $result = $statement->fetch();
            return $result['id_user'] ? $result['id_user'] : false;
        }

        static function deleteUser(int $userId) {
            Database::preparedQuery("DELETE FROM users WHERE id_user=?", [$userId]);
        }

        static function banUser(int $userId) {
            Database::preparedQuery("UPDATE users SET banned=1 WHERE id_user=?", [$userId]);
        }

        static function getUsers(int $start = -1, int $end = -1) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users ".
                (($start == -1 || $end == -1) ? "" : " WHERE id_user BETWEEN ? AND ?;"),
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

        static function searchUser($data) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users 
                WHERE nom=? OR prenom=? OR email=?;",
                [$data, $data, $data]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

?>