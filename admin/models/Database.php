<?php
    require_once 'config/config.php';

    class Database {
        static string $db = "";

        static function getConnection() {
            if(Database::$db != null)
                return Database::$db;

            try {
                $conn = new PDO($this->dsn, $this->username, $this->password);
            } catch (PDOException $e) {
                error_log("Error while connection to database: ".$e->getMessage());
                return false;
            }

            Database::$db = $conn;
            return $conn;
        }

        static function preparedQuery(string $request, array $params) {
            $conn = Database::getConnection();
            if(!$conn) return false;

            $statement = $conn->prepare($request);
            $statement->execute($params);
            return $statement;
        }
    }

?>