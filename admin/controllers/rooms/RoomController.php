<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';

    $title = "Gestion | Réservation";
    $selected = "rooms"; 

    require_once 'controllers/base_init.php';

    if(!isset($_GET['book_id'])) {
        header('Location: choice');
        exit();
    }
    $bookId = $_GET['book_id'];

    $reservation = Reservation::getReservation($bookId);
    if($reservation['id_hotel'] != $hotelId) {
        header('Location: choice');
        exit();
    }

    if(isset($_GET['action']) && $_GET['action'] == "edit") {
        $categorieId = $_GET['categorie'] ?? 0;
        $dateStart = $_GET['date_start'];
        $dateEnd = $_GET['date_end'];
        $paiement = $_GET['paiement'];
        
    }

    $categories = Reservation::getCategories();

    require 'views/dashboard_top.php';
    require 'views/rooms/room.php';
?>