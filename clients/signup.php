<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/perms.php';
    
    $databaseManager = new DatabaseManager();

    if(isset($_SESSION['id']) || isset($_COOKIE['id'])) {
        header('Location: panel.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stayLogged = $_POST['staylogged'];
        
        if(isset($email) && 
        isset($password) && 
        isset($address) &&
        isset($lastname) &&
        isset($firstname)
        ) {
            $statement = $databaseManager->preparedQuery(
                "INSERT INTO users(nom, prenom, addresse, email, hash) VALUES(?, ?, ?, ?, crypt(?, gen_salt('bf'))) RETURNING id_user;",
                [$lastname, $firstname, $address, $email, $password]
            );

            $id = $statement == false ? false : $statement->fetch();
            if($id === false) {
                echo 'An error as occured';
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

                header('Location: panel.php');
                exit();
            }
        } else {
            // TODO
            echo "Formulaire non complété";
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

    <form action="signup.php" method="POST">
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

        <label for="stay">Se souvenir de moi : </label>
        <input type="checkbox" name="staylogged" id="stay"><br>

        <input type="submit" value="S'inscrire"><br>
        <a href="login.php">Se connecter</a>
    </form>

</body>
</html>