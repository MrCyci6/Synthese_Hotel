<?php
    require_once 'models/Session.php';
    Session::start();

    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";

    // User part
    if(!Session::isUserLogged()) {
        header('Location: login.php');
        exit();
    } 
    
    $userId = $_SESSION['id'];
    if(!User::isUserAdmin($userId)) {
        header('Location: choice.php');
        exit();
    }
    $user = User::getUser($userId);

    // Hotel part
    $hotelId = $_GET['hotel_id'];
    if(!isset($hotelId) || empty($hotelId)) {
        header('Location: choice.php');
        exit();
    }    

    // Delete user
    if(isset($_GET['action']) && $_GET['action']=="delete") {
        if(isset($_GET['user_id']) && !empty($_GET['user_id'])) {
            User::deleteUser($_GET['user_id']);
        }
    }

    $hotels = Perms::getFilteredPermissionsByUser($userId);
    $hotelName = $hotels[$hotelId][0][0];
    $hotelClasse = $hotels[$hotelId][0][1];

    // List part
    $search = $_GET['search'];
    if(isset($search) && !empty($search))
        $userSearch = User::searchUser($search);
    
    $tablePage = $_GET['page'];
    if(!isset($tablePage) || empty($tablePage)) 
        $tablePage = 1;
    $tableStep = USER_LIST_STEP;

    $users = User::getUsers(($tablePage == 1 ? 1 : $tablePage*$tableStep-$tableStep), $tablePage*$tableStep);
    $prevPage = $tablePage==1 ? 1 : $tablePage-1;
    $nextPage = $tablePage+1;
    
    require 'views/dashboard_top.php';
    require 'views/users.php';
?>