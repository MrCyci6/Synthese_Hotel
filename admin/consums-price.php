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
if(isset($_POST['btn-save'])){
    for($i=0;$i<$nbConso;$i++){
        $new_price=$_POST['prix_'.$consommations[$i]['id_conso']];
        var_dump($new_price);
        Conso::modifPrix($new_price,$consommations[$i]['id_conso'],$hotel_id);
    }
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
