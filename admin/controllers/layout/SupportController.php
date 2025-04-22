<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';
    require_once 'models/Logs.php';

    $title = "Gestion | Support";
    $selected = "support";
    
    require_once 'controllers/permsMiddleware.php';

    if(!User::isAdmin($userId)) {
        header('Location: choice');
        exit();
    }

    require 'views/dashboard_top.php';
    require 'views/layout/support.php';

?>