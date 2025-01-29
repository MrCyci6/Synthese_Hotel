<?php
require_once('models/Conso.php');

$consommations=Conso::getConsoAndPrice(1);
$nbConso=count($consommations);


require('views/consums-price.php');