<?php

    class DashboardController {
        static function default() {
            require_once '../app/models/Session.php';
            Session::start();
        
            require_once '../app/models/Logs.php';
            require_once '../app/models/Perms.php';
            require_once '../app/models/Reservation.php';
            require_once '../app/models/User.php';
            require_once '../app/models/Hotel.php';
            require_once '../app/models/Conso.php';
        
            $title = "Tableau de bord";
            $selected = "dashboard";
        
            require_once '../app/controllers/base_init.php';
        
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
        
            require '../app/views/dashboard_top.php';
            require '../app/views/layout/resume.php';
        }
    }

?>