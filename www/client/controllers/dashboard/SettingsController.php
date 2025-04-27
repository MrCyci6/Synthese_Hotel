<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/User.php';
    require_once '../models/Reservation.php';
    require_once '../models/Conso.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $pageTitle = "Paramètres";

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/settings.php';
?>