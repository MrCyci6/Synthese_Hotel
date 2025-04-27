<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/Hotel.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $pageTitle = "Rechercher";

    $hotelList = HoteL::getHotels();

    $hotelId = $_GET['hotel'] ?? null;
    $dates = $_GET['dates'] ?? null;
    
    $hotel = null;
    $availableRooms = [];
    $dateDebut = null;
    $dateFin = null;
    
    if ($hotelId && $dates) {
    
        $hotel = HoteL::getHotel($hotelId);
        if ($hotel) {
            $datesArray = explode('_to_', $dates);
            if (count($datesArray) === 2) {
                $dateDebut = $datesArray[0];
                $dateFin = $datesArray[1];
    
                $availableRooms = HoteL::getAvailableRooms($hotelId, $dateDebut, $dateFin);
            }
        }
    }

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/search.php';
?>