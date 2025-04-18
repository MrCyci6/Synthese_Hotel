<?php
require_once 'models/Logs.php';
require_once 'models/Perms.php';
require_once 'models/Reservation.php';
require_once 'models/User.php';
require_once 'models/Hotel.php';
require_once 'models/Conso.php';

$consommations=Conso::getConsos($_GET['hotel_id'],"Order by cc.date_conso desc");
$nbConso=count($consommations);

$consommationsArray=Conso::getListConsos();
$nbList=count($consommationsArray);

$sejour=Reservation::getReservEnCours();
$nbSejour=count($sejour);

if (isset($_POST["menu"]) && isset($_POST["quantite"]) && isset($_POST["sejour"])){
    Conso::AjoutConsoClient($_POST["sejour"],$_POST["menu"],$_POST["quantite"]);
    $consommations=Conso::getConsos($_GET['hotel_id'],"Order by cc.date_conso desc");
    $nbConso=count($consommations);
}

$title = "Récapitulatif des Consommations";
$selected = "consums";

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
require('views/consums.php');
