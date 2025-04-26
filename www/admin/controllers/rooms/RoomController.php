<?php
    require_once '../models/Session.php';
    Session::start();

    require_once '../models/User.php';
    require_once '../models/Perms.php';
    require_once '../models/Reservation.php';
    require_once '../models/Logs.php';

    $title = "Gestion | Réservation";
    $selected = "rooms"; 

    require_once 'controllers/permsMiddleware.php';

    if(!isset($_GET['book_id'])) {
        header('Location: choice');
        exit();
    }
    $bookId = $_GET['book_id'];

    if(isset($_GET['action']) && $_GET['action'] == "edit") {
        $dateStart = $_GET['date_start'];
        $dateEnd = $_GET['date_end'];
        $paiement = $_GET['paiement'];

        Reservation::modifyBook($bookId, $dateStart, $dateEnd, $paiement);        
        Logs::addLog($userId, $hotelId, "A modifier la réservation $bookId");
    }

    $reservation = Reservation::getReservation($bookId);
    if($reservation['id_hotel'] != $hotelId) {
        header('Location: choice');
        exit();
    }

    $categories = Reservation::getCategories();

    require 'views/dashboard_top.php';
    require 'views/rooms/room.php';
?>