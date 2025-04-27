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
        "research" => "controllers/home/SearchController.php",
        "reservation" => "controllers/home/ReservationController.php",

        // Dashboard
        "dashboard" => "controllers/dashboard/HomeController.php",
        "settings" => "controllers/dashboard/SettingsController.php",
        "support" => "controllers/dashboard/TicketController.php",
        "search" => "controllers/dashboard/search/SearchController.php",
        "selection" => "controllers/dashboard/search/SelectionController.php",
        "reservations" => "controllers/dashboard/reservations/ReservationController.php",
        "details" => "controllers/dashboard/reservations/DetailsController.php",
        "facture" => "controllers/dashboard/FactureController.php",

        "success" => "controllers/actions/SuccessController.php",
        "confirm" => "controllers/actions/ConfirmController.php"
    ];

    if(isset($routes[$route]))
        require $routes[$route];
    else
        require $routes["404"];
?>