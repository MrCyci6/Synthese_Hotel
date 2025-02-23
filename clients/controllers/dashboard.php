<?php
require_once __DIR__ . '/../models/Session.php';
Session::start();

// Test si user connecté
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id'])) {
	header('Location: /login');
	exit();
}

require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Conso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (empty($_POST['reservationSelect']) || empty($_POST['consoName']) || empty($_POST['consoQty'])) { // ça évite les erreurs du type on clique sur le bouton alors qu'on a rien séléctionné
		header("Location: /dashboard/home");
		exit();
	}

	$sejourId = (int)$_POST['reservationSelect'];
	$consoId = (int)$_POST['consoName'];
	$consoQty = (int)$_POST['consoQty'];
	Conso::addConsommation($sejourId, $consoId, $consoQty);
	header("Location: /dashboard/home"); // PRG
	exit();
}


$page = $_GET['page'] ?? 'dashboard';
$view = $_GET['view'] ?? null;

// Si déconnexion demandée
if ($page === 'logout') {
	Session::destroy();
	header('Location: /login');
	exit();
}

if ($page === 'dashboard') {
	switch ($view) {
		case 'wishlist':
			$pageTitle = "Ma Wishlist";
			$viewFile = 'wishlist.php';
			break;
		case 'notifications':
			$pageTitle = "Mes Notifications";
			$viewFile = 'notifications.php';
			break;
		case 'search':
			$pageTitle = "Rechercher";
			$viewFile = 'search.php';
			break;
		case 'settings':
			$pageTitle = "Paramètres";
			$viewFile = 'settings.php';
			break;
		case 'home':
		default:
			$pageTitle = "Tableau de bord";
			$viewFile = 'home.php';
			$view = 'home';
			$clientId = $_SESSION['client_id']['id'];
			$daysLeft = Reservation::getDaysLeftInCurrentStay($clientId);
            $nextDeparture = Reservation::getNextDepartureDate($clientId);
			$occupancyRate = Reservation::getOccupancyRate($clientId);
			$ongoingReservations = Reservation::getOngoingReservationsByClient($clientId);
			if (!empty($ongoingReservations)) {
				$currentReservation = $ongoingReservations[0];
				$sejourId = $currentReservation['id_sejour'];
				$totalConsosAmount = Conso::getTotalConsommationsAmount($sejourId);
				$currentConsos = Conso::getConsommationsForSejour($currentReservation['id_sejour']);
			} else {
				$totalConsosAmount = 0;
				$currentConsos = [];
			}
			$historicalConsos = Conso::getHistoricalConsumptionsByClient($clientId);
			$availableConsos = Conso::getAllAvailableConsos();
		break;
	}
}

require_once __DIR__ . '/../views/layout.php';
