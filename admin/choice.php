<?php
    session_start();
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';
    require_once 'models/Chambre.php';
    require_once 'models/Reservation.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";

    // User part
    $userId = $_SESSION['id'];
    if(!isset($userId) || empty($userId)) {
        header('Location: login.php');
        exit();
    }

    // Hotels part    
    $perms = Perms::getFilteredPermissionsByUser($userId);
    if(sizeof($perms) <= 0) {
        // TODO: non admin
        header('Location: logout.php');
        exit();
    }

    $hotels = Hotel::getHotels();
    for($i = 0; $i < sizeof($hotels); $i++) {
        $hotels[$i]['chambres'] = Chambre::getRoomsCountByHotel($hotels[$i]['id_hotel']);
        $hotels[$i]['occupees'] = Reservation::getReservationsCountByHotel($hotels[$i]['id_hotel']);
    }

    require 'views/choice.php';
?>