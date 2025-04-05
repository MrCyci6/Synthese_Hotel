<?php

    // User part
    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }
    $userId = $_SESSION['userId'];
    $user = User::getUser($userId);

    // Hotels part    
    if(!isset($_GET['hotel_id'])) {
        header('Location: choice');
        exit();
    }
    $hotelId = $_GET['hotel_id'];

    // Perms
    $hotels = Perms::getFilteredPermissionsByUser($userId);
    if(!isset($hotels[$hotelId])) {
        header('Location: choice');
        exit();
    }

?>