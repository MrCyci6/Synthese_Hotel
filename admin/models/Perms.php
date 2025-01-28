<?php

    require_once 'models/Database.php';

    class Perms {

        static function updatePermissions(int $userId, int $hotelId, array $oldPerms, array $newPerms) {
            $toActivate = [];
            foreach ($oldPerms as $perm) {
                if (in_array($perm['id_perm'], $newPerms) && $perm['has'] == 0) {
                    array_push($toActivate, $perm['id_perm']);
                }
            }
            foreach($toActivate as $id) {
                Database::preparedQuery(
                    "INSERT INTO perms_users(id_perm, id_user, id_hotel) VALUES (?,?,?);",
                    [$id, $userId, $hotelId]
                );
            }

            $toDesactivate = [];
            foreach ($oldPerms as $perm) {
                if (!in_array($perm['id_perm'], $newPerms) && $perm['has'] == 1) {
                    array_push($toDesactivate, $perm['id_perm']);
                }
            }
            foreach($toDesactivate as $id) {
                Database::preparedQuery(
                    "DELETE FROM perms_users WHERE id_perm=? AND id_user=? AND id_hotel=?;",
                    [$id, $userId, $hotelId]
                );
            }
        }

        static function getPermissions() {
            $statement = Database::preparedQuery(
                "SELECT id_perm, nom FROM perms;", []
            );
            $perms = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $perms;
        }

        static function getPermission(int $permId) {
            $statement = Database::preparedQuery(
                "SELECT nom FROM perms WHERE id_perm=?;", 
                [$permId]
            );
            $perm = $statement->fetch();
            return $perm;
        }

        static function getPermissionsByHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT pu.id_perm, p.nom as permission, pu.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, h.id_hotel, h.nom as nom_hotel, cl.id_classe, cl.denomination as classe FROM perms_users pu
                INNER JOIN perms p ON p.id_perm=pu.id_perm
                INNER JOIN users u ON u.id_user=pu.id_user
                INNER JOIN hotel h ON h.id_hotel=pu.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE pu.id_hotel=?;",
                [$hotelId]
            );
            $permissions = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $permissions;
        }

        static function getPermissionsByUser(int $userId) {
            $statement = Database::preparedQuery(
                "SELECT pu.id_perm, p.nom as permission, pu.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, h.id_hotel, h.nom as nom_hotel, cl.id_classe, cl.denomination as classe FROM perms_users pu
                INNER JOIN perms p ON p.id_perm=pu.id_perm
                INNER JOIN users u ON u.id_user=pu.id_user
                INNER JOIN hotel h ON h.id_hotel=pu.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE pu.id_user=?;",
                [$userId]
            );
            $permissions = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $permissions;
        }
        
        static function getPermissionsByHotelAndUser(int $hotelId, int $userId) {
            $statement = Database::preparedQuery(
                "SELECT pu.id_perm, p.nom as permission, pu.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, h.id_hotel, h.nom as nom_hotel, cl.id_classe, cl.denomination as classe FROM perms_users pu
                INNER JOIN perms p ON p.id_perm=pu.id_perm
                INNER JOIN users u ON u.id_user=pu.id_user
                INNER JOIN hotel h ON h.id_hotel=pu.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                WHERE pu.id_hotel=? AND pu.id_user=?;",
                [$hotelId, $userId]
            );
            $permissions = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $permissions;
        }

        static function hasPermissionsByHotelAndUser(int $hotelId, int $userId) {
            $statement = Database::preparedQuery(
                "SELECT p.id_perm, p.nom AS perm,
                    CASE
                        WHEN pu.id_perm IS NOT NULL THEN 1
                        ELSE 0
                    END AS has 
                FROM perms p
                LEFT JOIN perms_users pu
                ON p.id_perm = pu.id_perm AND pu.id_user = ? AND pu.id_hotel = ?;",
                [$userId, $hotelId]
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        static function getFilteredPermissionsByUser(int $userId) {
            $statement = Database::preparedQuery(
                "SELECT pu.id_perm, pu.id_hotel, p.nom as perm, h.nom as hotel, c.denomination as classe FROM perms_users pu
                INNER JOIN perms p ON p.id_perm=pu.id_perm
                INNER JOIN hotel h ON pu.id_hotel=h.id_hotel
                INNER JOIN classe c ON c.id_classe=h.id_classe
                WHERE id_user=?
                ORDER BY pu.id_hotel, pu.id_perm;",
                [$userId]
            );

            $_hotels = $statement->fetchAll(PDO::FETCH_ASSOC);
            $hotels = [];
            foreach($_hotels as $hotel) {
                $hotelId = $hotel['id_hotel'];
                $permId = $hotel['id_perm'];

                if(!isset($hotels[$hotelId])) {
                    $hotels[$hotelId] = [
                        'name' => $hotel['hotel'],
                        'class' => $hotel['classe'],
                        'perms' => [],
                    ];
                }
        
                $hotels[$hotelId]['perms'][$permId] = $hotel['perm'];
            }

            /**
             * Format: 
             * [ 
             *      hotelId => [
             *          "name" => "Name",
             *          "class" => "Class",
             *          "perms" => [
             *              permId => "Name"
             *          ]
             *      ]
             * ]
             */
            return $hotels;
        }
    }

?>