<?php
require_once 'models/Logs.php';
require_once 'models/Perms.php';
require_once 'models/Reservation.php';
require_once 'models/User.php';
require_once 'models/Hotel.php';
require_once 'models/Conso.php';

$hotel_id=$_GET['hotel_id'];
$consommations=Conso::getConsoAndPrice($hotel_id);
$nbConso=count($consommations);

$title = "Prix Conso";
$selected = "consums-price";


$data = json_decode(file_get_contents("php://input"), true);

if ( !empty($data['consommations'])) {

    foreach ($data['consommations'] as $conso) {
        $conso_id = intval($conso["consommation_id"]);
        $prix = floatval($conso["prix"]);

        // Mise à jour du prix dans la base de données
        Conso::modifPrix($hotel_id,$conso_id);
    }

    echo "Prix mis à jour avec succès pour l'hôtel ID $hotel_id !";
}

// User part
$userId = 1;
if(!isset($userId) || empty($userId)) {
    header('Location: login.php');
    exit();
}
$user = User::getUser($userId);

// Hotel part
$hotelId = $_GET['hotel_id'];
if(!isset($hotelId) || empty($hotelId)) {
    header('Location: choice.php');
    exit();
}

$hotels = Perms::getFilteredPermissionsByUser($userId);
if(!isset($hotels[$hotelId])) {
    header('Location: choice.php');
    exit();
}

$hotelName = $hotels[$hotelId][0][0];
$hotelClasse = $hotels[$hotelId][0][1];


require('views/dashboard_top.php');
require('views/consums-price.php');
