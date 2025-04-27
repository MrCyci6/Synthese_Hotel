<?php

    $uri = $_SERVER['REQUEST_URI'] ?? "";
    $splitedUri = explode('/', $uri);
    $route = explode("?", $splitedUri[sizeof($splitedUri)-1])[0];

    $routes = [
        // General
        "" => "controllers/home/InfoController.php",
        "404" => "controllers/404Controller.php",

        //  Auth
        "logout" => "controllers/auth/LogoutController.php",
        "login" => "controllers/auth/LoginController.php",
        "register" => "controllers/auth/RegisterController.php",

        // Home
        "home" => "controllers/home/InfoController.php",
        "selection" => "controllers/home/SearchController.php",

        // Dashboard
        "dashboard" => "controllers/dashboard/HomeController.php",
        "notifications" => "controllers/dashboard/NotificationsController.php",
        "search" => "controllers/dashboard/SearchController.php",
        "settings" => "controllers/dashboard/SettingsController.php",
        "wishlist" => "controllers/dashboard/WishlistController.php",
        "support" => "controllers/support/TicketController.php"
    ];

    if(isset($routes[$route]))
        require $routes[$route];
    else
        require $routes["404"];
?>