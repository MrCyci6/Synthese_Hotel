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

    $sejourId = $_GET['id'] ?? 1;
    $sejour = Reservation::getReservation($sejourId);

    $clientId = $_SESSION['userId'];
    $user = User::getUser($clientId);

    $consos = Conso::getConsommationsForSejour($sejourId);
    $roomPrice = Reservation::getPrice($sejourId, $sejour['date_fin'], $sejour['date_debut']);

    require_once 'views/dashboard/facture.php';
?>