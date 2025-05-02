<?php

    require_once '../models/Session.php';
    Session::start();
    
    require_once '../models/Hotel.php';
    require_once '../models/Chambre.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $date_arrive = $_POST['date_arrive'] ?? ($_GET['date_arrive'] ?? null);
    $date_depart = $_POST['date_depart'] ?? ($_GET['date_depart'] ?? null);
    $id_hotel = isset($_POST['hotel']) ? (int)$_POST['hotel'] : ((int)$_GET['hotel'] ?? null);
    
    if (empty($date_arrive) || empty($date_depart) || empty($id_hotel)) {
        header('Location: home?error=missing_data');
        exit;
    }
    
    if (!strtotime($date_arrive) || !strtotime($date_depart) || strtotime($date_arrive) >= strtotime($date_depart)) {
        header('Location: home?error=invalid_dates');
        exit;
    }
    
    $chambres = Chambre::getRoomInfos($id_hotel, $date_arrive, $date_depart);
    if (empty($chambres)) {
        header('Location: home?error=no_rooms_available');
        exit;
    }
    
    $hotel_info = Hotel::getHotel($id_hotel);
    $chambres['hotel_nom'] = $hotel_info['nom_hotel'] ?? 'Hôtel inconnu';
    $chambres['form_data'] = [
        'date_arrive' => $date_arrive,
        'date_depart' => $date_depart,
        'id_hotel' => $id_hotel
    ];
    
    

    require_once 'views/home/search.php';
?>