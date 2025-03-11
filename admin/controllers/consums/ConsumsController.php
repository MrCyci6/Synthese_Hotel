<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Prix conso";
    $selected = "consums";

    require_once 'controllers/base_init.php';

    $consommations=Conso::getConsos($_GET['hotel_id'],"Order by cc.date_conso desc");
    $nbConso=count($consommations);

    require 'views/dashboard_top.php';
    require 'views/consums/consums.php';

?>