<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    if(Session::isUserLogged()) {
        header('Location: choice');
        exit();
    }

    // Form
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $id = User::loginUser($_POST['email'], $_POST['password']);

        if($id === false) {
            echo 'TODO: identifiants invalides';
            exit();
        } else {
            // TODO: $stayLogged = $_POST['staylogged'] ?? false;
            Session::loginUser($id);
            
            header('Location: choice');
            exit();
        }
    }

    require 'views/auth/login.php';

?>