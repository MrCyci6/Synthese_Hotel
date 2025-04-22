<?php
    session_start();
/*
    if (isset($_SESSION['client_id'])) {
        header('Location: views/home.php');
        exit();
    }
*/
    header('Location: info_hotels');
    exit();

