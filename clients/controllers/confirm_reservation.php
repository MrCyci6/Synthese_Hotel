<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
	// Rediriger vers la page de connexion avec un message d'erreur
	$redirect_url = '/reservation?' . http_build_query($_GET);
	header('Location: /login?redirect=' . urlencode($redirect_url) . '&error=login_required');
	exit();
}

// Récupérer le nom de l'hôtel
require_once __DIR__ . '/../models/Search.php';
$hotel_id = $_GET['hotel'] ?? null;
$hotel_info = $hotel_id ? Search::getHotelById($hotel_id) : null;
$hotel_nom = $hotel_info['nom'] ?? 'Hôtel inconnu';

// Préparer les données pour la vue
$data = [
	'hotel_nom' => $hotel_nom,
	'categorie' => $_GET['categorie'] ?? 'Non spécifié',
	'prix' => $_GET['prix'] ?? '0',
	'arriver' => $_GET['arriver'] ?? '-',
	'depart' => $_GET['depart'] ?? '-',
	'error' => $_GET['error'] ?? null,
];

$arrive = new DateTime($data['arriver']);
$depart = new DateTime($data['depart']);
$interval = $arrive->diff($depart);
$data['duree'] = $interval->days . ' nuit(s)';

// Inclure la vue
require_once __DIR__ . '/../views/home/Reservation.php';
?>