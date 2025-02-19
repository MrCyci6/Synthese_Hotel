<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';

    $title = "Gestion | Réservations";
    $selected = "rooms"; 

    require_once 'controllers/base_init.php';

    $tablePage = $_GET['page'] ?? 1;
    $tableStep = ROOMS_LIST_STEP;

    $reservations = Reservation::getReservations($hotelId, ($tablePage == 1 ? 1 : $tablePage*$tableStep-$tableStep), $tablePage*$tableStep);
    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;

    require 'views/dashboard_top.php';
    require 'views/rooms/rooms.php';
?>