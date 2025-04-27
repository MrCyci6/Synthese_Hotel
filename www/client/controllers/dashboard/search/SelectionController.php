<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/Hotel.php';
    require_once '../models/Chambre.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $pageTitle = "Séléction des chambres";
    $module = "search";

    $search_results = $_SESSION['search_results'] ?? [];
    $chambres = $search_results['chambres'] ?? [];
    $hotel_nom = $search_results['hotel_nom'] ?? 'Hôtel inconnu';
    $form_data = $search_results['form_data'] ?? [];

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/search/selection.php';
?>