<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/Hotel.php';
    require_once '../models/Reservation.php';
    require_once '../models/Conso.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $pageTitle = "Mes Réservations";
    $module = "reservations";

    $clientId = $_SESSION['userId'];
    $ongoingReservations = Reservation::getOngoingReservationsByClient($clientId);
    $pastReservations = Reservation::getPastReservationsByClient($clientId);

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/reservations/reservation.php';
?>