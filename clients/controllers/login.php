<?php
    session_start();
    require_once __DIR__ . '/../models/Client.php';


    if (isset($_SESSION['client_id'])) {
        header("Location: dashboard.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $clientId = Client::loginClient($email, $password);

        if ($clientId !== false) {
            $_SESSION['client_id'] = $clientId;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "TODO : Identifiants incorrects.";
        }
    }

    require '../views/login/login.php';
