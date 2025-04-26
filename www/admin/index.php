<?php

    $uri = $_SERVER['REQUEST_URI'] ?? "";
    $splitedUri = explode('/', $uri);
    $route = explode("?", $splitedUri[sizeof($splitedUri)-1])[0];

    $routes = [
        "" => "controllers/layout/DashboardController.php",
        "404" => "controllers/404Controller.php",
        "dashboard" => "controllers/layout/DashboardController.php",
        "choice" => "controllers/ChoiceController.php",
        "login" => "controllers/auth/LoginController.php",
        "logout" => "controllers/auth/LogoutController.php",
        "users" => "controllers/users/UsersController.php",
        "user" => "controllers/users/UserController.php",
        "rooms" => "controllers/rooms/RoomsController.php",
        "room" => "controllers/rooms/RoomController.php",
        "rooms-price" => "controllers/rooms/RoomsPriceController.php",
        "consums-price" => "controllers/consums/ConsumsPriceController.php",
        "consums" => "controllers/consums/ConsumsController.php",
        "logs" => "controllers/layout/LogsController.php",
        "support" => "controllers/layout/SupportController.php"
    ];

    if(isset($routes[$route]))
        require $routes[$route];
    else
        require $routes["404"]; 
?>