<?php
require_once 'model/Hotel.php';

$info_hotel = Hotel::getHotelIdName();

require 'views/index.php';
?>