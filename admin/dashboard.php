<?php
    session_start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Tableau de bord";
    $selected = "dashboard";

    // User part
    $userId = $_SESSION['id'];
    if(!isset($userId) || empty($userId)) {
        header('Location: login.php');
        exit();
    }
    $user = User::getUser($userId);

    // Hotel part
    $hotelId = $_GET['hotel_id'];
    if(!isset($hotelId) || empty($hotelId)) {
        header('Location: choice.php');
        exit();
    }
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    $hotelName = $hotels[$hotelId][0][0];
    $hotelClasse = $hotels[$hotelId][0][1];

    // Stats
    $reservationsCount = Reservation::getReservationsCountByHotel($hotelId);
    $roomsCount = Hotel::getHotelRoomsCount($hotelId);
    $consosCount = Conso::getConsosCount($hotelId);
    $sales = Hotel::getHotelSales($hotelId);

    // Bookings
    $reservations = Reservation::getReservationsByHotel($hotelId, "ORDER BY r.date_debut DESC LIMIT 3");
    $consos = Conso::getConsos($hotelId, "ORDER BY cc.date_conso DESC LIMIT 3");
    
    // Logs
    $logs = Logs::getLogsByHotel($hotelId, "ORDER BY l.date DESC LIMIT 5");

    require 'views/dashboard_top.php';
    require 'views/resume.php';
?>