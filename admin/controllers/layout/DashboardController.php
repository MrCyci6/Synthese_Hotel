<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/RoomSelection.php';
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
    $reservations = Reservation::getReservationsByHotel($hotelId, "ORDER BY r.date_debut DESC LIMIT 3");
    $consos = Conso::getConsos($hotelId, "ORDER BY cc.date_conso DESC LIMIT 3");
    
    // Logs
    $logs = Logs::getLogsByHotel($hotelId, "ORDER BY l.date DESC LIMIT 5");

    require 'views/dashboard_top.php';
    require 'views/layout/resume.php';

?>