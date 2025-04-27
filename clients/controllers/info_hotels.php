<?php
require_once __DIR__ . '/../models/Search.php';

$hotel_id_name = Search::getHotelId();

$hotels = Search::getHotelList();

$services = Search::getServices();

require __DIR__ . '/../views/home/Home.php';
?>