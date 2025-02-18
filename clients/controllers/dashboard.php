<?php
session_start();

require_once __DIR__ . '/../models/Client.php';

$page = $_GET['page'] ?? 'home';
$view = $_GET['view'] ?? null;

if ($page === 'dashboard') {
	switch ($view) {
		case 'wishlist':
			$pageTitle = "Ma Wishlist";
			$view = 'wishlist.php';
			break;
		case 'notifications':
			$pageTitle = "Mes Notifications";
			$view = 'notifications.php';
			break;
		case 'payment':
			$pageTitle = "Mes Paiements";
			$view = 'payment.php';
			break;
		case 'settings':
			$pageTitle = "Paramètres";
			$view = 'settings.php';
			break;
		case 'home':
		default:
			$pageTitle = "Tableau de bord";
			$view = 'home.php';
			break;
	}
}

require_once __DIR__ . '/../views/layout.php';
