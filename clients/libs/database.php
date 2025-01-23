<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/config/config.php';

    class DatabaseManager {
        private string $dsn = ""; 
        private string $username = ""; 
        private string $password = "";

        function __construct() {
            $this->dsn = "pgsql:dbname=".DB_NAME.";host=".DB_HOST.";port=".DB_PORT;
            $this->username = DB_USERNAME;
            $this->password = DB_PASSWORD;
        }

        function getConnection() {
            try {
                $conn = new PDO($this->dsn, $this->username, $this->password);
                return $conn;
            } catch (PDOException $e) {
                return false;
            }
        }

        function preparedQuery(string $request, array $params) {
            $conn = $this->getConnection();
            if(!$conn) return false;

            $statement = $conn->prepare($request);
            $statement->execute($params);
            return $statement;
        }
    }
?>