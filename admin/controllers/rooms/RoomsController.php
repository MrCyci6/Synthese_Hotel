<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';

    $title = "Gestion | Réservations";
    $selected = "rooms"; 

    require_once 'controllers/base_init.php';

    $tableStep = ROOMS_LIST_STEP;
    $tablePage = $_GET['page'] ?? 1;

    if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])) {
        $reservations = Reservation::searchReservation($_GET['search'], $hotelId, $tableStep, $tablePage);
    } else {   
        $reservations = Reservation::getReservations($hotelId, $tableStep, $tablePage);
    }
    
    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;

    require 'views/dashboard_top.php';
    require 'views/rooms/rooms.php';
?>