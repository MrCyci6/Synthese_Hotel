<?php
require_once 'model/Hotel.php';
$hotel_id_name = Hotel::getHotelIdName();
require 'views/index.php';
?>