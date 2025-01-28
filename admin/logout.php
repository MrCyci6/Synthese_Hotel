<?php
    session_start();

    // Déstruction de la session
    session_unset();
    session_destroy();

    //Déstruction du cookie
    if(isset($_COOKIE['id'])) setcookie('id', '', time()-1, "/");
    
    header('Location: login.php');
    exit();
?>