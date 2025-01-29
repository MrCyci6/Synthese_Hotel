<?php
    require_once 'config/config.php';

    class Database {
        static $db = "";

        static function getConnection() {
            if(Database::$db != null)
                return Database::$db;

            $dsn = "pgsql:dbname=".DB_NAME.";host=".DB_HOST.";port=".DB_PORT;
            $username = DB_USERNAME;
            $password = DB_PASSWORD;
            try {
                $conn = new PDO($dsn, $username, $password);
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