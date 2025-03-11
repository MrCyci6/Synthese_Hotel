<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Prix conso";
    $selected = "consums-price";

    require_once 'controllers/base_init.php';

    $consommations = Conso::getConsoAndPrice($hotelId);
    $nbConso = count($consommations);

    $denom = array();
    foreach ($consommations as $consommation) {
        array_push($denom, $consommation['denomination']);
    }

    // Add conso
    if(isset($_POST['new_conso']) && isset($_POST['new_price']) && !in_array($_POST['new_conso'], $denom)) {
        Conso::ajoutConso($_POST['new_conso'], $_POST['new_price'], $hotelId);
        $consommations = Conso::getConsoAndPrice($hotelId);
    }

    require 'views/dashboard_top.php';
    require 'views/consums/consums-price.php';

?>