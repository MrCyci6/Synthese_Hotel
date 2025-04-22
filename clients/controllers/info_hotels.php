<?php
require_once __DIR__ . '/../models/Search.php';
$hotel_id_name = Search::getHotelId();
require_once __DIR__ . '/../views/home/home.php';
?>