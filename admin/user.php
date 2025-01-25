<?php
    session_start();
    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Logs.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";

    // User part
    $userId = $_SESSION['id'];
    if(!isset($userId) || empty($userId)) {
        header('Location: login.php');
        exit();
    } else if($userId!=ADMIN_ID) {
        header('Location: choice.php');
        exit();
    }
    $user = User::getUser($userId);

    // Hotel part
    $hotelId = $_GET['hotel_id'];
    if(!isset($hotelId) || empty($hotelId)) {
        header('Location: choice.php');
        exit();
    }
    
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    $hotelName = $hotels[$hotelId][0][0];
    $hotelClasse = $hotels[$hotelId][0][1];

    // Target part
    $targetId = $_GET['user_id'];
    if(!isset($targetId) || empty($targetId)) {
        header("Location: users.php?hotel_id=$hotelId");
        exit();
    }

    // Actions
    $action = $_GET['action'];
    if(!empty($action)) {
        switch($action) {
            case "ban":
                User::banUser($targetId);
                //Logs::addLog($userId, $hotelId, "Bannissement de $targetId");
                break;
            case "edit":
                $nom = $_GET['nom']; $prenom = $_GET['prenom']; $email = $_GET['email'];
                $addresse = $_GET['addresse']; $password = $_GET['password'] ?? "";
                if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($addresse)) {
                    User::updateUser($targetId, $nom, $prenom, $email, $addresse, $password);
                    //Logs::addLog($userId, $hotelId, "Mise à jour les informations de $targetId");
                }
                break;
            case "perms":
                $oldPerms = Perms::hasPermissionsByHotelAndUser($hotelId, $targetId);
                $newPerms = $_GET['perms'];
                if(isset($newPerms) && !empty($newPerms)) {
                    Perms::updatePermissions($targetId, $hotelId, $oldPerms, $newPerms);
                    //Logs::addLog($userId, $hotelId, "Mise à jour les permissions de $targetId");
                }
                break;
        }
    }

    // -
    $target = User::getUser($targetId);
    $perms = Perms::hasPermissionsByHotelAndUser($hotelId, $targetId);
    $logs = Logs::getLogsByUser($targetId, "ORDER BY l.date DESC LIMIT 10");

    require 'views/dashboard_top.php';
    require 'views/user.php';
?>