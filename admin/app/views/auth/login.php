<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/login.css">

    <title>Administration</title>
</head>
<body>
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