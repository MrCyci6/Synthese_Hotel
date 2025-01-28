<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';
    require_once 'models/Chambre.php';
    require_once 'models/Hotel.php';

    $title = "Gestion | Utilisateurs";

    // User part
    if(!Session::isUserLogged()) {
        header('Location: login.php');
        exit();
    }
    $userId = $_SESSION['userId'];

    // Hotels part    
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    if(sizeof($hotels) <= 0) {
        header('Location: logout.php');
        exit();
    }

    foreach($hotels as $hotelId => $hotelData) {
        $hotels[$hotelId]['rooms'] = Hotel::getRoomsCount($hotelId);
        $hotels[$hotelId]['occupedRooms'] = Hotel::getOccupedRoomsCount($hotelId);
    }

    require 'views/choice.php';
?>