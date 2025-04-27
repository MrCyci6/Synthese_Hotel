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


    $pageTitle = "Détails de la Réservation";
    $module = "reservations";
    $clientId = $_SESSION['userId'];
    
    $reservationId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $reservation = Reservation::getReservationById($reservationId, $clientId);
    $consommations = Conso::getConsommationsForSejour($reservationId);

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/reservations/details.php';
?>