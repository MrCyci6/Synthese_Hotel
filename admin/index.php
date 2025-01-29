<?php
    $uri = $_SERVER['REQUEST_URI'] ?? "";
    $splitedUri = explode('/', $uri);
    $route = explode("?", $splitedUri[sizeof($splitedUri)-1])[0];

    $routes = [
        "" => "controllers/auth/LoginController.php",
        "dashboard" => "controllers/layout/DashboardController.php",
        "choice" => "controllers/ChoiceController.php",
        "login" => "controllers/auth/LoginController.php",
        "logout" => "controllers/auth/LogoutController.php",
        "users" => "controllers/users/UsersController.php",
        "user" => "controllers/users/UserController.php"
    ];

    if(isset($routes[$route]))
        require $routes[$route];
    else
        require $routes[""]; 
?>