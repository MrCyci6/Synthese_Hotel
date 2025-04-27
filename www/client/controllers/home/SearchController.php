<?php

    require_once '../models/Session.php';
    Session::start();
    
    require_once '../models/Hotel.php';
    require_once '../models/Chambre.php';

    $date_arrive = $_POST['arriver'] ?? null;
    $date_depart = $_POST['depart'] ?? null;
    $id_hotel = isset($_POST['hotel']) ? (int)$_POST['hotel'] : null;
    $chambres = [];
    
    if (!empty($date_arrive) && !empty($date_depart) && !empty($id_hotel)) {
        if (strtotime($date_arrive) < strtotime($date_depart)) {
            $chambres = Chambre::getRoomInfos($id_hotel, $date_arrive, $date_depart);
        } else {
            header('Location: home?error=invalid_dates');
            exit();
        }
    } else {
        header('Location: home?error=missing_data');
        exit();
    }
    
    // Ajouter le nom de l'hôtel pour l'affichage
    $hotel_info = Hotel::getHotel($id_hotel);
    $chambres[$id_hotel]['hotel_nom'] = $hotel_info['nom'] ?? 'Hôtel inconnu';
    
    // Passer les données du formulaire pour pré-remplissage
    $chambres['form_data'] = [
        'date_arrive' => $date_arrive,
        'date_depart' => $date_depart,
        'id_hotel' => $id_hotel
    ];
    

    require_once 'views/home/search.php';
?>