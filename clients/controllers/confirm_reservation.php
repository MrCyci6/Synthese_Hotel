<?php
session_start();
require_once __DIR__ . '/../models/Search.php';
require_once __DIR__ . '/../models/Reservation.php';

if (!isset($_SESSION['id_user'])) {
	$redirect_url = '/reservation?' . http_build_query($_POST);
	header('Location: /login?redirect=' . urlencode($redirect_url) . '&error=login_required');
	exit;
}

$hotel_id = $_POST['hotel_id'] ?? null;
$categorie = $_POST['categorie'] ?? null;
$prix = $_POST['prix'] ?? null;
$date_arrive = $_POST['date_arrive'] ?? null;
$date_depart = $_POST['date_depart'] ?? null;

if (!$hotel_id || !$categorie || !$prix || !$date_arrive || !$date_depart) {
	$data = [
		'hotel_nom' => 'Hôtel inconnu',
		'categorie' => $categorie ?? 'Non spécifié',
		'prix' => $prix ?? '0',
		'date_arrive' => $date_arrive ?? 'Non spécifiée',
		'date_depart' => $date_depart ?? 'Non spécifiée',
		'error' => 'Données de réservation incomplètes.',
		'duree' => 'Non calculée'
	];
	require __DIR__ . '/../views/home/Reservation.php';
	exit;
}

if (!strtotime($date_arrive) || !strtotime($date_depart)) {
	$data = [
		'hotel_nom' => 'Hôtel inconnu',
		'categorie' => $categorie,
		'prix' => $prix,
		'date_arrive' => $date_arrive,
		'date_depart' => $date_depart,
		'error' => 'Dates de réservation invalides.',
		'duree' => 'Non calculée'
	];
	require __DIR__ . '/../views/home/Reservation.php';
	exit;
}

$reservation_id = Reservation::createReservationWithTransaction(
	(int)$_SESSION['id_user'],
	(int)$hotel_id,
	$categorie,
	$date_arrive,
	$date_depart,
	floatval($prix)
);

if ($reservation_id === false || !is_int($reservation_id) || $reservation_id <= 0) {
	$data = [
		'hotel_nom' => Search::getHotelById($hotel_id)['nom'] ?? 'Hôtel inconnu',
		'categorie' => $categorie,
		'prix' => $prix,
		'date_arrive' => $date_arrive,
		'date_depart' => $date_depart,
		'error' => 'Échec de la création de la réservation.',
		'duree' => (new DateTime($date_depart))->diff(new DateTime($date_arrive))->days . ' nuit(s)'
	];
	require __DIR__ . '/../views/home/Reservation.php';
	exit;
}

header('Location: /reservation_success?reservation_id=' . $reservation_id);
exit;