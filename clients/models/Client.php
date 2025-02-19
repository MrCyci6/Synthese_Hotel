<?php
require_once __DIR__ . '/Database.php';

class Client
{
    /**
     * Authentifie le client et retourne ses données si le login est réussi.
     *
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public static function loginClient($email, $password)
    {
        $query = "SELECT id_user, nom, prenom, email, hash 
              FROM users 
              WHERE email = :email";
        $params = [':email' => $email];

        $client = Database::preparedQuery($query, $params)->fetch(PDO::FETCH_ASSOC);

        if ($client && password_verify($password, $client['hash'])) {
            return $client;
        }
        return false;
    }

    /**
     * Met à jour le profil du client.
     *
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $address
     * @return bool
     */
    public static function updateProfile($id, $nom, $prenom, $email, $address)
    {
        $query = "UPDATE users 
                  SET nom = :nom, prenom = :prenom, email = :email, addresse = :address 
                  WHERE id_user = :id";
        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':address' => $address,
            ':id' => $id
        ];
        return Database::preparedQuery($query, $params);
    }

    /**
     * Change le mot de passe du client.
     *
     * @param int $id
     * @param string $newPassword
     * @return bool
     */
    public static function changePassword($id, $newPassword)
    {
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET hash = :hash WHERE id_user = :id";
        $params = [
            ':hash' => $newHash,
            ':id' => $id
        ];
        return Database::preparedQuery($query, $params);
    }

}
