<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/database.php';    

    $databaseManager = new DatabaseManager();

    // Session
    if(!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
        header('Location: login.php');
        exit();
    }
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : $_COOKIE['id'];

    // Perms
    $statement = $databaseManager->preparedQuery(
        "SELECT pu.id_perm, pu.id_hotel, p.nom FROM perms_users pu
        INNER JOIN perms p USING(id_perm)
        WHERE id_user=?
        ORDER BY pu.id_hotel, pu.id_perm;",
        [$userId]
    );
    $_hotels = $statement->fetchAll(PDO::FETCH_ASSOC);
    $hotels = array();
    for($i = 0; $i < sizeof($_hotels); $i++) {
        $_perm = $_hotels[$i]['id_perm'];
        $_hotel = $_hotels[$i]['id_hotel'];
        $_name = $_hotels[$i]['nom'];

        $hotels[$_hotel][$_perm] = $_name;
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

    <nav>
        <a href="logout.php">Déconnexion</a>
    </nav>

    <?php  

        // Test affichage
        echo "Voici vos permissions par hotel:<br>";
        foreach($hotels as $hotelId => $perms) {
            echo "Hotel $hotelId :<br>";
            foreach($perms as $id => $perm) {
                echo "- ($id) $perm<br>";
            }
        }
    
    ?>

</body>
</html>