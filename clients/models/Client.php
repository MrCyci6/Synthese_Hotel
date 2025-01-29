<?php
require_once __DIR__ . '/Database.php';

class Client {
    public static function loginClient($email, $password) {
        $query = "SELECT id_user, hash FROM users WHERE email = :email";
        $params = [':email' => $email];

        $client = Database::preparedQuery($query, $params)->fetch(PDO::FETCH_ASSOC);

        if ($client && password_verify($password, $client['hash_user'])) {
            return $client['id_user'];
        }
        return false;
    }

    public static function getReservations($userId) {
        $query = "SELECT id_sejour, date_debut, date_fin 
                  FROM RESERVATION 
                  WHERE id_user = :id_user";
        $params = [':id_user' => $userId];

        return Database::preparedQuery($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getConsommations($sejourId) {
        $query = "SELECT id_cc, date_conso, nombre, pc.prix*nombre as prix_total
                  FROM conso_client
                  JOIN public.prix_conso pc on conso_client.id_conso = pc.id_conso
                  WHERE id_sejour = :id_sejour";
        $params = [':id_sejour' => $sejourId];

        return Database::preparedQuery($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
