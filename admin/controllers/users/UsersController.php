<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';
    require_once 'models/Logs.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";
    
    require_once 'controllers/permsMiddleware.php';

    if(!User::isAdmin($userId) && !isset($hotels[$hotelId]["perms"][1])) {
        header('Location: choice');
        exit();
    }

    // Delete user
    if(isset($_GET['action']) && $_GET['action']=="delete") {
        if(isset($_GET['user_id']) && !empty($_GET['user_id']) && !User::isAdmin($_GET['user_id'])) {
            User::deleteUser($_GET['user_id']);
            Logs::addLog($userId, $hotelId, "A supprimer l'utilisateur ".$_GET['user_id']);
        }
    }

    // Create
    if(isset($_GET['action']) && $_GET['action'] == "create") {
        if(isset($_GET['email']) && !empty($_GET['email'])) {
            $nom = $_GET['nom'] ?? "";
            $prenom = $_GET['prenom'] ?? "";
            $adresse = $_GET['adresse'] ?? "";
            $email = $_GET['email'];

            if(sizeof(User::searchUserByEmail($email)) == 0) {
                $password = User::addUser($nom, $prenom, $adresse, $email);
                Logs::addLog($userId, $hotelId, "A créer l'utilisateur $email");
            } else {
                $error = "Cette adresse e-mail est déjà liée à un compte utilisateur";
            }
        }
    }

    // Table part
    $tablePage = $_GET['page'] ?? 1;
    $tableStep = USER_LIST_STEP;

    if(isset($_GET['search'])) {
        $users = User::searchUser($_GET['search'], $tableStep, $tablePage);
    } else {
        $users = User::getUsers($tableStep, $tablePage);
    }

    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;
    
    require 'views/dashboard_top.php';
    require 'views/users/users.php';

?>