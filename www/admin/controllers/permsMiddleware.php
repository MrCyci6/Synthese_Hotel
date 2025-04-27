<?php

    // User part
    if(!Session::isUserLogged()) {
        header('Location: login');
        exit();
    }
    $userId = $_SESSION['userId'];
    $user = User::getUser($userId);

    if($user['banned']) {
        header('Location: logout');
        exit();
    }

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

    // Perms checker
    $routePerms = [
        "users" => [1],
        "user" => [1],
        "rooms" => [1, 2],
        "room" => [1, 2],
        "rooms-price" => [1, 4],
        "consums-price" => [1, 5],
        "consums" => [1, 3],
        "logs" => [1, 7],
        "support" => []
    ];

    if(isset($routePerms[$route]) && !User::isAdmin($userId)) {
        $granted = false;
        foreach ($hotels[$hotelId]["perms"] as $idPerm => $perm) {
            if(in_array($idPerm, $routePerms[$route])) {
                $granted = true;
            }
        }

        if(!$granted) {
            header('Location: choice');
            exit();
        }
    }
?>