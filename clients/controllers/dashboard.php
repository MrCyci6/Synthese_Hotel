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
require_once __DIR__ . '/../models/Search.php';
require_once __DIR__ . '/../models/Chambres.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['action']) && $_POST['action'] === 'search_rooms') {
		$hotel_id = isset($_POST['location']) ? (int)$_POST['location'] : null;
		$date_arrive = $_POST['date_arrive'] ?? null;
		$date_depart = $_POST['date_depart'] ?? null;


		if (empty($hotel_id) || empty($date_arrive) || empty($date_depart)) {
			$error = 'missing_data';
			if (empty($hotel_id)) $error .= '_no_hotel';
			if (empty($date_arrive)) $error .= '_no_date_arrive';
			if (empty($date_depart)) $error .= '_no_date_depart';
			header('Location: /dashboard?page=dashboard&view=search&error=' . $error);
			exit;
		}

		if (!strtotime($date_arrive) || !strtotime($date_depart) || strtotime($date_arrive) >= strtotime($date_depart)) {
			header('Location: /dashboard?page=dashboard&view=search&error=invalid_dates');
			exit;
		}

		$chambres = Chambres::getRoomInfos($hotel_id, $date_arrive, $date_depart);
		if (empty($chambres)) {
			header('Location: /dashboard?page=dashboard&view=search&error=no_rooms_available');
			exit;
		}

		$_SESSION['search_results'] = [
			'chambres' => $chambres,
			'hotel_nom' => $hotel_info['nom'] ?? 'Hôtel inconnu',
			'form_data' => [
				'date_arrive' => $date_arrive,
				'date_depart' => $date_depart,
				'id_hotel' => $hotel_id
			]
		];
		header('Location: /dashboard?page=dashboard&view=room_selection');
		exit;
	}

	if (empty($_POST['reservationSelect']) || empty($_POST['consoName']) || empty($_POST['consoQty'])) {
		header("Location: /dashboard/home");
		exit();
	}

	$sejourId = (int)$_POST['reservationSelect'];
	$consoId = (int)$_POST['consoName'];
	$consoQty = (int)$_POST['consoQty'];
	Conso::addConsommation($sejourId, $consoId, $consoQty);
	header("Location: /dashboard/home");
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
		case 'reservations':
			$pageTitle = "Mes Réservations";
			$viewFile = 'reservations.php';
			$clientId = $_SESSION['client_id']['id'];
			$ongoingReservations = Reservation::getOngoingReservationsByClient($clientId);
			$pastReservations = Reservation::getPastReservationsByClient($clientId);
			break;
		case 'reservation_details':
			$pageTitle = "Détails de la Réservation";
			$viewFile = 'reservation_details.php';
			$clientId = $_SESSION['client_id']['id'];
			$reservationId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
			$reservation = Reservation::getReservationById($reservationId, $clientId);
			$consommations = Conso::getConsommationsForSejour($reservationId);
			break;
		case 'settings':
			$pageTitle = "Paramètres";
			$viewFile = 'settings.php';
			break;
		case 'search':
			$pageTitle = "Rechercher";
			$viewFile = 'search.php';
			$hotelList = Search::getHotelList();
			$error = $_GET['error'] ?? null;
			break;
		case 'room_selection':
			$pageTitle = "Sélection des Chambres";
			$viewFile = 'RoomSelection.php';
			$search_results = $_SESSION['search_results'] ?? [];
			$chambres = $search_results['chambres'] ?? [];
			$hotel_nom = $search_results['hotel_nom'] ?? 'Hôtel inconnu';
			$form_data = $search_results['form_data'] ?? [];
			break;
		case 'confirm_reservation':
			$pageTitle = "Confirmation de Réservation";
			$viewFile = 'confirm_reservation.php';
			require __DIR__ . '/confirm_reservation.php';
			break;
		case 'home':
		default:
			$pageTitle = "Tableau de bord";
			$viewFile = 'Home.php';
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
?>