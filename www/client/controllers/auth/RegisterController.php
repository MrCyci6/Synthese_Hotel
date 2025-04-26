<?php

    require_once '../models/Session.php';
    Session::start();

    require_once '../models/User.php';
    require_once '../models/Hotel.php';
    require_once '../models/Perms.php';
    require_once '../models/Logs.php';

    if(Session::isUserLogged()) {
        header('Location: support');
        exit();
    }

    // Form
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address'])) {
        if(sizeof(User::searchUserByEmail($_POST['email'])) != 0) {
            echo "TODO: email déja utilisé";
            exit();
        }
        
        User::addUser($_POST["lastname"], $_POST["firstname"], $_POST["address"], $_POST["email"], $_POST["password"]);
        $id = User::loginUser($_POST['email'], $_POST['password']);

        if($id === false) {
            echo 'TODO: identifiants invalides';
            exit();
        }
        
        Session::loginUser($id);
        
        Logs::addLog($id, 1, "Connexion: ".$_SERVER['REMOTE_ADDR']);
        
        header('Location: support');
        exit();
    }

    require 'views/auth/register.php';

?>