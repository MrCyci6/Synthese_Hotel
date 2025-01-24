<?php

    require_once 'models/Database.php';

    class Perms {

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
        
            $hotels = array();
            foreach($_hotels as $hotel) {
                $_perm = $hotel['id_perm'];
                $_hotel = $hotel['id_hotel'];
                $_permName = $hotel['perm'];
                $_hotelName = $hotel['hotel'];
                $_hotelClass = $hotel['classe'];
        
                $hotels[$_hotel][0] = [$_hotelName, $_hotelClass];
                $hotels[$_hotel][$_perm] = $_permName;
            }

            /**
             * Format: 
             * [ 
             *      "id_hotel1": {
             *          0: [
             *                  "hotel_name",
             *                  "hotel_classe"
             *              ],
             *          id_perm1: "Nom perm 1",
             *          id_perm2: "Nom perm1"
             *      }
             * ]
             */
            return $hotels;
        }
    }

?>