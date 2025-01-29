<?php
require_once('models/Conso.php');

$consommations=Conso::getConsos(1);
$nbConso=Conso::getConsosCount(1);


require('views/consums-price.php');