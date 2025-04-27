<?php

    require_once '../models/Session.php';
    Session::start();
    
    require_once '../models/Hotel.php';
    require_once '../models/Reservation.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $module = "search";
    
    $hotel_id = $_POST['hotel_id'] ?? null;
    $categorie = $_POST['categorie'] ?? null;
    $prix = $_POST['prix'] ?? null;
    $date_arrive = $_POST['date_arrive'] ?? null;
    $date_depart = $_POST['date_depart'] ?? null;
    
    if (!$hotel_id || !$categorie || !$prix || !$date_arrive || !$date_depart) {
        $data = [
            'hotel_nom' => 'Hôtel inconnu',
            'categorie' => $categorie ?? 'Non spécifié',
            'prix' => $prix ?? '0',
            'date_arrive' => $date_arrive ?? 'Non spécifiée',
            'date_depart' => $date_depart ?? 'Non spécifiée',
            'error' => 'Données de réservation incomplètes.',
            'duree' => 'Non calculée'
        ];
        require 'views/dashboard/layout.php';
        require 'views/dashboard/reservation.php';
        exit();
    }
    
    if (!strtotime($date_arrive) || !strtotime($date_depart)) {
        $data = [
            'hotel_nom' => 'Hôtel inconnu',
            'categorie' => $categorie,
            'prix' => $prix,
            'date_arrive' => $date_arrive,
            'date_depart' => $date_depart,
            'error' => 'Dates de réservation invalides.',
            'duree' => 'Non calculée'
        ];
        require 'views/dashboard/layout.php';
        require 'views/dashboard/reservation.php';
        exit();
    }
    
    $reservation_id = Reservation::createReservationWithTransaction(
        (int)$_SESSION['userId'],
        (int)$hotel_id,
        $categorie,
        $date_arrive,
        $date_depart,
        floatval($prix)
    );
    
    if ($reservation_id === false || !is_int($reservation_id) || $reservation_id <= 0) {
        $data = [
            'hotel_nom' => Hotel::getHotel($hotel_id)['nom'] ?? 'Hôtel inconnu',
            'categorie' => $categorie,
            'prix' => $prix,
            'date_arrive' => $date_arrive,
            'date_depart' => $date_depart,
            'error' => 'Échec de la création de la réservation.',
            'duree' => (new DateTime($date_depart))->diff(new DateTime($date_arrive))->days . ' nuit(s)'
        ];
        require 'views/dashboard/layout.php';
        require 'views/dashboard/reservation.php';
        exit();
    }
    
    header('Location: success?reservation_id=' . $reservation_id);
?>