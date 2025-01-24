<?php
    session_start();
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    if(isset($_SESSION['id'])) {
        header('Location: choice.php');
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $stayLogged = $_POST['staylogged'];

    if(isset($email) && isset($password)) {
        $id = User::loginUser($email, $password);

        if($id === false) {
            echo 'TODO: identifiants invalides';
            exit();
            // TODO
        } else {
            $_SESSION['id'] = $id;
            // if($stayLogged == "on") {
            //     setcookie('id', $id, time() + (15), "/"); // cookie de 15 secondes
            // }

            header('Location: choice.php');
            exit();
        }
    }

    require 'views/login.php'
?>