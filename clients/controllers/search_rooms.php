<?php
require_once __DIR__ . '/../models/Chambres.php';
require_once __DIR__ . '/../models/Search.php';

$date_arrive = $_POST['date_arrive'] ?? null;
$date_depart = $_POST['date_depart'] ?? null;
$id_hotel = isset($_POST['hotel']) ? (int)$_POST['hotel'] : null;

if (empty($date_arrive) || empty($date_depart) || empty($id_hotel)) {
	header('Location: /home?error=missing_data');
	exit;
}

if (!strtotime($date_arrive) || !strtotime($date_depart) || strtotime($date_arrive) >= strtotime($date_depart)) {
	header('Location: /home?error=invalid_dates');
	exit;
}

$chambres = Chambres::getRoomInfos($id_hotel, $date_arrive, $date_depart);
if (empty($chambres)) {
	header('Location: /home?error=no_rooms_available');
	exit;
}

$hotel_info = Search::getHotelById($id_hotel);
$chambres['hotel_nom'] = $hotel_info['nom'] ?? 'Hôtel inconnu';
$chambres['form_data'] = [
	'date_arrive' => $date_arrive,
	'date_depart' => $date_depart,
	'id_hotel' => $id_hotel
];

require __DIR__ . '/../views/home/RoomSelection.php';
?>