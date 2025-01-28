<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    if(Session::isUserLogged()) {
        header('Location: choice.php');
        exit();
    }

    // Form
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $id = User::loginUser($_POST['email'], $_POST['password']);

        if($id === false) {
            echo 'TODO: identifiants invalides';
            exit();
            // TODO
        } else {
            // TODO: $stayLogged = $_POST['staylogged'] ?? false;
            Session::loginUser($id);
            
            header('Location: choice.php');
            exit();
        }
    }

    require 'views/login.php'
?>