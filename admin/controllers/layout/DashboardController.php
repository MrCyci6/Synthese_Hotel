<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Tableau de bord";
    $selected = "dashboard";

    require_once 'controllers/base_init.php';

    // Stats
    $reservationsCount = Reservation::getReservationsCountByHotel($hotelId);
    $roomsCount = Hotel::getRoomsCount($hotelId);
    $occupedRoomsCount = Hotel::getOccupedRoomsCount($hotelId);
    $consosCount = Conso::getConsosCount($hotelId);
    $sales = Hotel::getSales($hotelId);

    // Bookings
    $reservations = Reservation::getReservations($hotelId, 3, 1);
    $consos = Conso::getConsos($hotelId, 3, 1);
    
    // Logs
    $logs = Logs::getLogsByHotel($hotelId, "ORDER BY l.date DESC LIMIT 5");

    require 'views/dashboard_top.php';
    require 'views/layout/resume.php';

?>