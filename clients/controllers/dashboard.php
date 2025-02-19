<?php
session_start();

// Test si user connecté
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id'])) {
	header('Location: login.php');
	exit();
}

require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Conso.php';

$page = $_GET['page'] ?? 'dashboard';
$view = $_GET['view'] ?? null;

// Si déconnexion demandée
if ($page === 'logout') {
	session_unset();
	session_destroy();
	header('Location: login.php');
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
		case 'payment':
			$pageTitle = "Mes Paiements";
			$viewFile = 'payment.php';
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
			} else {
				$totalConsosAmount = 0;
			}
			break;
	}
}

require_once __DIR__ . '/../views/layout.php';
