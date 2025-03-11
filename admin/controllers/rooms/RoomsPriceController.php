<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Chambre.php';

    $title = "Gestion | Prix Chambres";
    $selected = "rooms-price"; 

    require_once 'controllers/base_init.php';

    $infoChambre=Chambre::getRoomsInfo($_GET['hotel_id']);
    $nbChambre=count($infoChambre);

    // Modify
    if(isset($_POST['id_chambre']) && isset($_POST['new_price'])){
        Chambre::modifyPrice($infoChambre[$_POST['id_chambre']-1]['id_classe'],$infoChambre[$_POST['id_chambre']-1]['cate'], $_POST['new_price']);
        $infoChambre=Chambre::getRoomsInfo($_GET['hotel_id']);
    }

    require 'views/dashboard_top.php';
    require 'views/rooms/rooms-price.php';
?>