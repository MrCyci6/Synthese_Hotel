<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/Hotel.php';
    require_once '../models/Chambre.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $pageTitle = "Rechercher";
    $module = "search";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $hotel_id = isset($_POST['location']) ? (int)$_POST['location'] : null;
		$date_arrive = $_POST['date_arrive'] ?? null;
		$date_depart = $_POST['date_depart'] ?? null;


		if (empty($hotel_id) || empty($date_arrive) || empty($date_depart)) {
			$error = 'missing_data';
			if (empty($hotel_id)) $error .= '_no_hotel';
			if (empty($date_arrive)) $error .= '_no_date_arrive';
			if (empty($date_depart)) $error .= '_no_date_depart';
			header('Location: search?error=' . $error);
			exit;
		}

		if (!strtotime($date_arrive) || !strtotime($date_depart) || strtotime($date_arrive) >= strtotime($date_depart)) {
			header('Location: search?error=invalid_dates');
			exit;
		}

		$chambres = Chambre::getRoomInfos($hotel_id, $date_arrive, $date_depart);
		if (empty($chambres)) {
			header('Location: search?error=no_rooms_available');
			exit;
		}
		
        $hotel_info = Hotel::getHotel($hotel_id);
		$_SESSION['search_results'] = [
			'chambres' => $chambres,
			'hotel_nom' => $hotel_info['nom_hotel'] ?? 'Hôtel inconnu',
			'form_data' => [
				'date_arrive' => $date_arrive,
				'date_depart' => $date_depart,
				'id_hotel' => $hotel_id
			]
		];
		header('Location: selection');
		exit;
    }

    $hotelList = Hotel::getHotels();
    $error = $_GET['error'] ?? null;

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/search/search.php';
?>