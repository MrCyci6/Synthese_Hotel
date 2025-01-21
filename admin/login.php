<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/perms.php';

    $databaseManager = new DatabaseManager();

    if(isset($_SESSION['id']) || isset($_COOKIE['id'])) {
        header('Location: choice.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stayLogged = $_POST['staylogged'];
        
        if(isset($email) && isset($password)) {
            $statement = $databaseManager->preparedQuery(
                "SELECT id_user FROM users WHERE email=? AND hash=crypt(?, hash);",
                [$email, $password]
            );

            $id = $statement == false ? false : $statement->fetch();
            if($id === false) {
                echo 'TODO: identifiants invalides';
                exit();
                // TODO
            } else {
                $id = $id['id_user'];

                $statement = $databaseManager->preparedQuery(
                    "SELECT id_perm FROM perms_users WHERE id_user=?",
                    [$id]
                );

                $isAdmin = $statement == false ? false : checkPerm($statement->fetch(), 1);

                if(!$isAdmin) {
                    //header('Location: https://hotel.local/');
                    echo "TODO: non admin, redirection hotel.local";
                    exit();
                }

                $_SESSION['id'] = $id;
                if($stayLogged == "on") {
                    setcookie('id', $id, time() + (15), "/"); // cookie de 15 secondes
                }

                header('Location: choice.php');
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/login.css">

    <title>Administration</title>
</head>
<body>

    <nav>
        
    </nav>

    <section>
        <form action="login.php" method="POST">
            <p>Connexion</p>
            
            <input type="text" name="email" id="email"><br>
            <input type="password" name="password" id="password"><br>
            
            <div>
                <label for="stay">Rester connecter : </label>
                <input type="checkbox" name="staylogged" id="stay"><br>
            </div>

            <input type="submit" value="Connexion" id="connexion"><br>
            <input type="submit" value="Inscription" id="inscription">
        </form>
    </section>

</body>
</html>