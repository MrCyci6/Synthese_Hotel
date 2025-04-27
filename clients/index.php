<?php
    session_start();
/*
    if (isset($_SESSION['client_id'])) {
        header('Location: views/Home.php');
        exit();
    }
*/
    header('Location: home');
    exit();

