<?php

    class LoginController {
        static function default() {
            require_once '../app/models/Session.php';
            Session::start();
        
            require_once '../app/models/User.php';
            require_once '../app/models/Hotel.php';
            require_once '../app/models/Perms.php';
        
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
                } else {
                    // TODO: $stayLogged = $_POST['staylogged'] ?? false;
                    Session::loginUser($id);
                    
                    header('Location: choice.php');
                    exit();
                }
            }
        
            require '../app/views/auth/login.php';
        }
    }

?>