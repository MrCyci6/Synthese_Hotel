<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Gestion | Prix consommations";
    $selected = "consums-price";

    require_once 'controllers/permsMiddleware.php';

    $consommations = Conso::getConsoAndPrice($hotelId);
    $nbConso = count($consommations);

    $noConso=Conso::ConsoNonPresente($hotelId);
    $nbNoConso=count($noConso);

    $denom = array();
    foreach ($consommations as $consommation) {
        array_push($denom, $consommation['denomination']);
    }

    if(isset($_POST['menu'])){
        if($_POST['menu']=='option1' && !empty($_POST['new_conso']) && isset($_POST['new_price']) && $_POST['new_price']>0 && !in_array($_POST['new_conso'], $denom)) {
            Conso::ajoutConso($_POST['new_conso'],$_POST['new_price'],$hotelId);
            $consommations=Conso::getConsoAndPrice($hotelId);
            $nbConso=count($consommations);
        }
        elseif (isset($_POST['new_price']) && $_POST['new_price']>0 && !in_array($_POST['menu'], $denom)){
            Conso::ajoutConsoExistante($_POST['menu'],$_POST['new_price'],$hotelId);
            $consommations=Conso::getConsoAndPrice($hotelId);
            $nbConso=count($consommations);
        }
    }
    
    if(isset($_POST['menu2'])){
        if ($_POST['menu2']!='option1' && isset($_POST['new_price2']) && $_POST['new_price2']>0){
            Conso::ModifPrice($_POST['new_price2'],$_POST['menu2'],$hotelId);
            $consommations=Conso::getConsoAndPrice($hotelId);
            $nbConso=count($consommations);
        }
    }

    require 'views/dashboard_top.php';
    require 'views/consums/consums-price.php';

?>