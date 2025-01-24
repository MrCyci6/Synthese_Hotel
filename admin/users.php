<?php
    session_start();
    require_once 'models/User.php';
    require_once 'models/Hotel.php';
    require_once 'models/Perms.php';

    $title = "Gestion | Utilisateurs";
    $selected = "users";

    // User part
    $userId = $_SESSION['id'];
    if(!isset($userId) || empty($userId)) {
        header('Location: login.php');
        exit();
    } else if($userId!=ADMIN_ID) {
        header('Location: choice.php');
        exit();
    }
    $user = User::getUser($userId);

    // Hotels part
    $hotels = Perms::getFilteredPermissionsByUser($userId);

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