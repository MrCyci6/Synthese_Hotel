<?php

require_once __DIR__ . '/../models/Search.php';

// Config pour afficher la view
$pageTitle = "Rechercher";
$viewFile = 'search.php';

// Afficher le dropdown des hôtels + categorie
$hotelList = Search::getHotelList();

$hotelId = $_GET['hotel'] ?? null;
$dates = $_GET['dates'] ?? null;

$hotel = null;
$availableRooms = [];
$dateDebut = null;
$dateFin = null;

if ($hotelId && $dates) {

	$hotel = Search::getHotelById($hotelId);
	if ($hotel) {
		$datesArray = explode('_to_', $dates);
		if (count($datesArray) === 2) {
			$dateDebut = $datesArray[0];
			$dateFin = $datesArray[1];

			$availableRooms = Search::getAvailableRooms($hotelId, $dateDebut, $dateFin);
		}
	}
}