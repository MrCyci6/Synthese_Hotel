<?php
session_start();

require_once __DIR__ . '/../models/Client.php';

// $datefin = Client::getReservations($_SESSION['id']);

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
	case 'wishlist':
		$pageTitle = "Ma Wishlist";
		$view = 'views/wishlist.php';
		break;
	case 'reservations':
		$pageTitle = "Mes Réservations";
		$view = 'views/reservations.php';
		break;
	default:
		$pageTitle = "Dashboard";
		$view = 'home.php';
		break;
}

require_once __DIR__ . '/../views/layout.php';
