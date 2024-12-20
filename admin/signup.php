<?php
    session_start();
    //require_once $_SERVER['DOCUMENT_ROOT'].'/libs/database.php'; quand le serveur sera setup
    require_once './libs/database.php';

    $databaseManager = new DatabaseManager();

    if(isset($_SESSION['id']) || isset($_COOKIE['id'])) {
        header('Location: panel.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $address = $_POST['address']
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(isset($email) && isset($password)) {
            
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration</title>
</head>
<body>

    <form action="login.php" method="POST">
        <label for="lastname">Nom :</label>
        <input type="text" name="lastname" id="lastname">

        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" id="firstname"><br>
        <br>

        <label for="address">Adresse postale :</label><br>
        <input type="text" name="address" id="address"><br>
        <br>

        <label for="email">E-mail :</label><br>
        <input type="text" name="email" id="email"><br>
        <br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password"><br>
        <br>

        <input type="submit" value="S'inscrire"><br>
        <a href="login.php">Se connecter</a>
    </form>

</body>
</html>