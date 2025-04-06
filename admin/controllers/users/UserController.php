<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Logs.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users"; 

    require_once 'controllers/permsMiddleware.php';

    // Perm
    if(!User::isAdmin($userId) && !isset($hotels[$hotelId]["perms"][1])) {
        header('Location: choice');
        exit();
    }

    // Target part
    if(!isset($_GET['user_id'])) {
        header("Location: users?hotel_id=$hotelId");
        exit();
    }
    $targetId = $_GET['user_id'];

    // Actions
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            case "ban":
                if(!User::isAdmin($targetId)) {
                    User::banUser($targetId);
                    Logs::addLog($userId, $hotelId, "A banni $targetId");
                }
                break;
            case "unban":
                if(!User::isAdmin($targetId)) {
                    User::unbanUser($targetId);
                    Logs::addLog($userId, $hotelId, "A débanni $targetId");
                }
                break;
            case "edit":
                $nom = $_GET['nom']; 
                $prenom = $_GET['prenom']; 
                $email = $_GET['email'];
                $addresse = $_GET['addresse']; 
                $password = $_GET['password'] ?? "";

                if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($addresse)) {
                    User::updateUser($targetId, $nom, $prenom, $email, $addresse, $password);
                    Logs::addLog($userId, $hotelId, "A mise à jour les informations de $targetId");
                }
                break;
            case "perms":
                $oldPerms = Perms::hasPermissionsByHotelAndUser($hotelId, $targetId);
                $newPerms = $_GET['perms'] ?? [];
                
                if(!User::isAdmin($targetId)) {
                    Perms::updatePermissions($targetId, $hotelId, $oldPerms, $newPerms);
                    Logs::addLog($userId, $hotelId, "A mise à jour les permissions de $targetId");
                }
                break;
        }
    }

    // -
    $target = User::getUser($targetId);
    $perms = Perms::hasPermissionsByHotelAndUser($hotelId, $targetId);
    $logs = Logs::getLogsByUser($targetId, "ORDER BY l.date DESC LIMIT 10");

    require 'views/dashboard_top.php';
    require 'views/users/user.php';

?>