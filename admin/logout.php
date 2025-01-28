<?php
    require_once 'models/Session.php';
    
    Session::start();
    Session::logoutUser();

    header('Location: login.php');
?>