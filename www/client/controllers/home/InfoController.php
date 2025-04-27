<?php

    require_once '../models/Session.php';
    Session::start();
    
    require_once '../models/Hotel.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }
    
    $hotel_id_name = Hotel::getHotelId();

    $hotels = Hotel::getHotels();
    
    $services = Hotel::getServices();

    require_once 'views/home/home.php';
?>