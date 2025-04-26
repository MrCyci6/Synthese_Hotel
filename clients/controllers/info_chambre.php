<?php
require_once __DIR__ . '/../models/Chambres.php';
require_once __DIR__ . '/../models/Search.php';

$date_arrive = $_POST['arriver'] ?? null;
$date_depart = $_POST['depart'] ?? null;
$id_hotel = isset($_POST['hotel']) ? (int)$_POST['hotel'] : null;
$chambres = [];

if (!empty($date_arrive) && !empty($date_depart) && !empty($id_hotel)) {
    if (strtotime($date_arrive) < strtotime($date_depart)) {
        $chambres = Chambres::getRoomInfos($id_hotel, $date_arrive, $date_depart);
    } else {
        header('Location: /info_hotels?error=invalid_dates');
        exit();
    }
} else {
    header('Location: /info_hotels?error=missing_data');
    exit();
}

$hotel_info = Search::getHotelById($id_hotel);
$chambres[$id_hotel]['hotel_nom'] = $hotel_info['nom'] ?? 'Hôtel inconnu';

require __DIR__ . '/../views/home/Reservation.php';
