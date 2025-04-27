<?php

    require_once '../models/Session.php';
    require_once '../models/Logs.php';

    Session::start();
    Session::logoutUser();


    header('Location: login');

?>