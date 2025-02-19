<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Perms.php';
    require_once 'models/Hotel.php';
    require_once 'models/User.php';

    $title = "Gestion | Utilisateurs";

    // User
    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }
    $userId = $_SESSION['userId'];

    // Hotels part    
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    if(sizeof($hotels) <= 0) {
        header('Location: logout');
        exit();
    }

    foreach($hotels as $hotelId => $hotelData) {
        $hotels[$hotelId]['rooms'] = Hotel::getRoomsCount($hotelId);
        $hotels[$hotelId]['occupedRooms'] = Hotel::getOccupedRoomsCount($hotelId);
    }

    require 'views/choice.php';

?>