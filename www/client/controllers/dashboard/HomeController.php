<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/User.php';
    require_once '../models/Reservation.php';
    require_once '../models/Conso.php';
    require_once '../models/Hotel.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['reservationSelect']) || empty($_POST['consoName']) || empty($_POST['consoQty'])) { // ça évite les erreurs du type on clique sur le bouton alors qu'on a rien séléctionné
            header("Location: dashboard");
            exit();
        }
    
        $sejourId = (int)$_POST['reservationSelect']; // évite les erreur de conversions avec la Db avec (int)
        $consoId = (int)$_POST['consoName'];
        $consoQty = (int)$_POST['consoQty'];
        Conso::AjoutConsoClient($sejourId, $consoId, $consoQty);
        header("Location: dashboard"); // PRG
        exit();
    }

    $pageTitle = "Tableau de bord";
    $module = "home";
    
    $clientId = $_SESSION['userId'];
    $user = User::getUser($clientId);

    $daysLeft = Reservation::getDaysLeftInCurrentStay($clientId);
    $nextDeparture = Reservation::getNextDepartureDate($clientId);
    $occupancyRate = Reservation::getOccupancyRate($clientId);
    $ongoingReservations = Reservation::getOngoingReservationsByClient($clientId);
    
    if (!empty($ongoingReservations)) {
        $currentReservation = $ongoingReservations[0];
        $sejourId = $currentReservation['id_sejour'];
        $totalConsosAmount = Conso::getTotalConsommationsAmount($sejourId);
        $currentConsos = Conso::getConsommationsForSejour($currentReservation['id_sejour']);
    } else {
        $totalConsosAmount = 0;
        $currentConsos = [];
    }
    $historicalConsos = Conso::getHistoricalConsumptionsByClient($clientId);
    $availableConsos = Conso::getListConsos();
    
    $hotel_id_name = Hotel::getHotelId();
    $hotels = Hotel::getHotels();
    $services = Hotel::getServices();

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/home.php';
?>