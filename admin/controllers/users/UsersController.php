<?php

    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";
    
    require_once 'controllers/base_init.php';

    if(!User::isAdmin($userId)) {
        header('Location: choice');
        exit();
    }

    // Delete user
    if(isset($_GET['action']) && $_GET['action']=="delete") {
        if(isset($_GET['user_id']) && !empty($_GET['user_id']) && !User::isAdmin($_GET['user_id'])) {
            User::deleteUser($_GET['user_id']);
        }
    }

    // Perms
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    if(!isset($hotels[$hotelId])) {
        header('Location: choice');
        exit();
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