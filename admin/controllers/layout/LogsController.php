<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Perms.php';
    require_once 'models/Logs.php';

    $title = "Gestion | Activité";
    $selected = "logs"; 

    require_once 'controllers/permsMiddleware.php';

    $tableStep = LOGS_LIST_STEP;
    $tablePage = $_GET['page'] ?? 1;

    if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])) {
        $logs = Logs::searchLogs($_GET['search'], $hotelId, $tableStep, $tablePage);
    } else {   
        $logs = Logs::getLogs($hotelId, $tableStep, $tablePage);
    }
    
    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;

    require 'views/dashboard_top.php';
    require 'views/layout/logs.php';
?>