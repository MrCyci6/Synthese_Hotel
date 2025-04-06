<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/Logs.php';
    require_once 'models/Perms.php';
    require_once 'models/Reservation.php';
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Conso.php';

    $title = "Gestion | Consommations";
    $selected = "consums";

    require_once 'controllers/permsMiddleware.php';
    
    // Table part
    $tablePage = $_GET['page'] ?? 1;
    $tableStep = CONSOS_LIST_STEP;

    if(isset($_GET['search'])) {
        $consommations = Conso::searchConsos($_GET['search'], $hotelId, $tableStep, $tablePage);
    } else {
        $consommations = Conso::getConsos($hotelId, $tableStep, $tablePage);
    }

    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;

    require 'views/dashboard_top.php';
    require 'views/consums/consums.php';

?>