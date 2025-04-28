<?php

    require_once '../models/Session.php';
    Session::start();
    
    require_once '../models/Hotel.php';
    require_once '../models/Chambre.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    // Récupération des paramètres GET
    $hotel_id = $_GET['hotel'] ?? null;
    $categorie = $_GET['categorie'] ?? null;
    $prix = $_GET['prix'] ?? null;
    $date_arrive = $_GET['date_arrive'] ?? null;
    $date_depart = $_GET['date_depart'] ?? null;

    // Validation des données
    if (!$hotel_id || !$categorie || !$prix || !$date_arrive || !$date_depart) {
        $data = [
            'hotel_nom' => 'Hôtel inconnu',
            'categorie' => $categorie ?? 'Non spécifié',
            'prix' => $prix ?? '0',
            'date_arrive' => $date_arrive ?? 'Non spécifiée',
            'date_depart' => $date_depart ?? 'Non spécifié',
            'duree' => 'Non calculée',
            'error' => 'Veuillez vérifier que toutes les informations de réservation sont complètes.'
        ];
    } else {
        // Récupération des informations de l'hôtel
        $hotel_info = Hotel::getHotel($hotel_id);
        $arrive = new DateTime($date_arrive);
        $depart = new DateTime($date_depart);
        $interval = $arrive->diff($depart);
        $duree = $interval->days . ' nuit(s)';

        // Préparation des données pour la vue
        $data = [
            'hotel_id' => $hotel_id,
            'hotel_nom' => $hotel_info['nom_hotel'] ?? 'Hôtel inconnu',
            'categorie' => $categorie,
            'prix' => $prix,
            'date_arrive' => $date_arrive,
            'date_depart' => $date_depart,
            'duree' => $duree
        ];
    }
    
    

    require_once 'views/home/reservation.php';
?>