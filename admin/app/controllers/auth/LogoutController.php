<?php

    class LogoutController {
        static function default() {
            require_once '../app/models/Session.php';
    
            Session::start();
            Session::logoutUser();

            header('Location: login.php');
        }
    }

?>