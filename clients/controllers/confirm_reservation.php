<?php
session_start();
require_once __DIR__ . '/../models/Search.php';
require_once __DIR__ . '/../models/Chambres.php';

if (!isset($_SESSION['id_user'])) {
	$redirect_url = '/reservation?' . http_build_query($_GET);
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
		'arriver' => $date_arrive,
		'depart' => $date_depart,
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
		'arriver' => $date_arrive,
		'depart' => $date_depart,
		'error' => 'Dates de réservation invalides.',
		'duree' => 'Non calculée'
	];
	require __DIR__ . '/../views/home/Reservation.php';
	exit;
}

$hotel_info = Search::getHotelById($hotel_id);
$arrive = new DateTime($date_arrive);
$depart = new DateTime($date_depart);
$interval = $arrive->diff($depart);
$duree = $interval->days . ' nuit(s)';

$reservation_id = Chambres::createReservation(
	(int)$hotel_id,
	$categorie,
	floatval($prix),
	$date_arrive,
	$date_depart,
	(int)$_SESSION['id_user']
);

if ($reservation_id) {
	header('Location: /reservation_success?reservation_id=' . $reservation_id);
	exit;
}

$data = [
	'hotel_nom' => $hotel_info['nom'] ?? 'Hôtel inconnu',
	'categorie' => $categorie,
	'prix' => $prix,
	'arriver' => $date_arrive,
	'depart' => $date_depart,
	'error' => 'Erreur lors de la création de la réservation. Aucune chambre disponible.',
	'duree' => $duree
];
require __DIR__ . '/../views/home/Reservation.php';
?>