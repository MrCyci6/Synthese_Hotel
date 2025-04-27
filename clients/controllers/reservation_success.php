<?php
session_start();
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Search.php';

$reservation_id = $_GET['reservation_id'] ?? null;
if (!$reservation_id || !is_numeric($reservation_id)) {
	header('Location: /home?error=invalid_reservation_id');
	exit;
}

$reservation = Reservation::getReservation($reservation_id);
if (!$reservation || !isset($reservation['id_chambre']) || (isset($_SESSION['id_user']) && $reservation['id_user'] != $_SESSION['id_user'])) {
	header('Location: /home?error=invalid_reservation');
	exit;
}

$chambre_info = Reservation::getChambreInfo((int)$reservation['id_chambre']);
if (!$chambre_info || !isset($chambre_info['id_hotel'])) {
	header('Location: /home?error=invalid_chambre');
	exit;
}

$hotel_info = Search::getHotelById((int)$chambre_info['id_hotel']);
if (!$hotel_info) {
	header('Location: /home?error=invalid_hotel');
	exit;
}

$arrive = new DateTime($reservation['date_arrivee']);
$depart = new DateTime($reservation['date_fin']);
$duree = $arrive->diff($depart)->days . ' nuit(s)';

$data = [
	'hotel_nom' => $hotel_info['nom'] ?? 'Hôtel inconnu',
	'categorie' => $chambre_info['categorie'] ?? 'Non spécifié',
	'prix' => $chambre_info['prix'] ?? $reservation['paiement'] ?? '0',
	'date_arrive' => $reservation['date_arrivee'] ?? 'Non spécifiée',
	'date_depart' => $reservation['date_fin'] ?? 'Non spécifiée',
	'duree' => $duree,
	'reservation_id' => $reservation_id
];

require __DIR__ . '/../views/home/ReservationSuccess.php';