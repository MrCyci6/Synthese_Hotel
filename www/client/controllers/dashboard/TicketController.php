<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/User.php';

    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }

    $userId = $_SESSION['userId'];
    $user = User::getUser($userId);

    $pageTitle = "Assistance";

    require_once 'views/dashboard/layout.php';
    require_once 'views/dashboard/ticket.php';
?>