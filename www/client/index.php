<?php

    $uri = $_SERVER['REQUEST_URI'] ?? "";
    $splitedUri = explode('/', $uri);
    $route = explode("?", $splitedUri[sizeof($splitedUri)-1])[0];

    $routes = [
        "" => "controllers/auth/LoginController.php",
        "404" => "controllers/404Controller.php",
        "logout" => "controllers/auth/LogoutController.php",
        "login" => "controllers/auth/LoginController.php",
        "register" => "controllers/auth/RegisterController.php",
        "support" => "controllers/support/TicketController.php"
    ];

    if(isset($routes[$route]))
        require $routes[$route];
    else
        require $routes["404"];
?>