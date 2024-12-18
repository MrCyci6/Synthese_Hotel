<?php
    session_start();
    //require_once $_SERVER['DOCUMENT_ROOT'].'/libs/database.php'; quand le serveur sera setup
    require_once './libs/database.php';

    $databaseManager = new DatabaseManager();

    if(isset($_SESSION['id']) || isset($_COOKIE['id'])) {
        header('Location: panel.php');
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $stayLogged = $_POST['staylogged'];
    
    if(isset($email) && isset($password)) {
        $statement = $databaseManager->preparedQuery(
            "SELECT id_user FROM users WHERE email=? AND hash=crypt(?, hash);",
            [$email, $password]
        );

        $id = $statement->fetch();
        if($id === false) {
            // error
            echo 'identifiants invalides';
            // TODO
        } else {
            $id = $id['id_user'];

            $_SESSION['id'] = $id;
            if($stayLogged == "on") {
                setcookie('id', $id, time() + (15), "/"); // cookie de 15 secondes
            }

            header('Location: panel.php');
            exit();
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
        <label for="email">Identifiant :</label><br>
        <input type="text" name="email" id="email"><br>
        <br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password"><br>
        <br>
        <label for="stay">Rester connecter : </label>
        <input type="checkbox" name="staylogged" id="stay"><br>
        <input type="submit" value="Se connecter">
    </form>

</body>
</html>