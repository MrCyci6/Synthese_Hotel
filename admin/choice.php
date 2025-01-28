<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';
    require_once 'models/Chambre.php';
    require_once 'models/Hotel.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";

    // User part
    if(!Session::isUserLogged()) {
        header('Location: login.php');
        exit();
    }
    $userId = $_SESSION['userId'];

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
        $hotels[$i]['occupees'] = Hotel::getHotelRoomsCount($hotels[$i]['id_hotel'])['occupees'];
    }

    require 'views/choice.php';
?>