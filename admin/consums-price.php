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

$denom=array();
foreach ($consommations as $consommation) {
    array_push($denom,$consommation['denomination']);
}

$title = "Prix Conso";
$selected = "consums-price";

if(isset($_POST['new_conso']) && isset($_POST['new_price']) && !in_array($_POST['new_conso'], $denom)) {
    Conso::ajoutConso($_POST['new_conso'],$_POST['new_price'],$hotel_id);

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
