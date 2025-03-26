<?php

    require_once 'models/Database.php';

    class User {

        static function isAdmin(int $userId) {
            return $userId == ADMIN_ID;
        }

        static function updateUser(int $userId, string $nom, string $prenom, string $email, string $addresse, string $password = "") {
            Database::preparedQuery(
                "UPDATE users SET 
                nom=?, prenom=?, addresse=?, email=?".
                ($password == "" ? " " : ", hash=crypt(?, gen_salt('bf')) ").
                "WHERE id_user=?",
                ($password == "" ? [$nom, $prenom, $addresse, $email, $userId] : [$nom, $prenom, $addresse, $email, $password, $userId])
            );
        }

        static function loginUser(string $email, string $password) {
            $statement = Database::preparedQuery(
                "SELECT id_user FROM users WHERE email=? AND hash=crypt(?, hash);",
                [$email, $password]
            );
            $result = $statement->fetch();
            return $result['id_user'] ?? false;
        }

        static function deleteUser(int $userId) {
            Database::preparedQuery("DELETE FROM users WHERE id_user=?", [$userId]);
        }

        static function banUser(int $userId) {
            Database::preparedQuery("UPDATE users SET banned=1 WHERE id_user=?", [$userId]);
        }

        static function unbanUser(int $userId) {
            Database::preparedQuery("UPDATE users SET banned=0 WHERE id_user=?", [$userId]);
        }

        static function getUsers(int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users
                ORDER BY id_user ASC
                LIMIT ? OFFSET ?;",
                [$limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function searchUser(string $data, int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users 
                WHERE LOWER(nom) LIKE LOWER('%' || ? || '%') 
                OR LOWER(prenom) LIKE LOWER('%' || ? || '%') 
                OR LOWER(email) LIKE LOWER('%' || ? || '%')
                ORDER BY id_user ASC
                LIMIT ? OFFSET ?;",
                [$data, $data, $data, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function searchUserByEmail(string $email) {
            $statement = Database::preparedQuery(
                "SELECT id_user, nom, prenom, addresse, email, banned FROM users
                WHERE email=?",
                [$email]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        static function addUser(string $nom, string $prenom, string $adresse, string $email) {
            $password = uniqid();
            
            Database::preparedQuery(
                "INSERT INTO users(nom, prenom, addresse, email, hash, banned) VALUES (?, ?, ?, ?, ?, 0);",
                [$nom, $prenom, $adresse, $email, $password]
            );

            return $password;
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
    }

?>