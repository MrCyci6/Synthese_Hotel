<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/database.php';

    $databaseManager = new DatabaseManager();

    if(!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
        header('Location: login.php');
        exit();
    }
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : $_COOKIE['id'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrations | Hotels</title>

    <link rel="stylesheet" href="./styles/choice.css">
    <script src="https://kit.fontawesome.com/c4352304cc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar px-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-building fa-xl me-2" style="color: #74C0FC;"></i>
                <h3 class="m-0 dt">Au-Tel-2-Lux | Administration</h3>
            </div>
            <div class="d-flex align-items-center">
                <?php 
                if($userId==ADMIN_ID)
                    echo "<a href=\"permissions.php\" class=\"text-decoration-none d-flex align-items-center justify-content-around text-secondary me-3\">
                        <i class=\"fa-solid fa-gear\"></i>
                        <h5 class=\"ms-1 mt-1\">Gérer les permissions</h5>
                    </a>"
                ?>
                <a href="logout.php" class="text-decoration-none d-flex align-items-center justify-content-around text-secondary">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <h5 class="ms-1 mt-1">Déconnexion</h5>
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5">
        <div class="row g-4">
            <?php
                $statement = $databaseManager->preparedQuery("
                    SELECT h.id_hotel, h.nom, c.denomination, COUNT(ch.id_chambre) as chambres, COUNT(r.id_sejour) as reservations FROM hotel h
                    INNER JOIN classe c ON c.id_classe=h.id_classe
                    LEFT JOIN chambre ch ON ch.id_hotel=h.id_hotel
                    LEFT JOIN reservation r ON r.id_chambre=ch.id_chambre AND NOW() BETWEEN r.date_debut AND r.date_fin ".
                    ($userId==ADMIN_ID ? "" : "INNER JOIN perms_users p ON p.id_user=? AND p.id_hotel=h.id_hotel")
                    ." GROUP BY h.id_hotel, h.nom, c.denomination
                    ORDER BY h.id_hotel ASC;", 
                    ($userId==ADMIN_ID ? [] : [$userId])
                );
                $hotels = $statement->fetchAll(PDO::FETCH_ASSOC);

                if($userId != ADMIN_ID && sizeof($hotels) == 0) {
                    //header('Location: https://hotel.local/');
                    echo "TODO: non admin, redirection hotel.local";
                    exit();
                }

                foreach($hotels as $_hotel) {
                    echo "<div class=\"col-md-4\">
                        <a href=\"panel.php?hotel_id=".$_hotel['id_hotel']."\" class=\"card-link\">
                            <div class=\"card p-3 shadow\" style=\"border-radius: 12px; border: none;\">
                                <div class=\"d-flex align-items-start\">
                                    <div class=\"bg-light rounded p-3 me-3\" style=\"width: 50px; height: 50px;\">
                                        <i class=\"fa-solid fa-hotel fa-xl\" style=\"color: #74C0FC;\"></i>
                                    </div>
                                    <div>
                                        <h5 class=\"mb-0\">".$_hotel['nom']."</h5>
                                        <small class=\"text-muted\">".$_hotel['denomination']."</small>
                                    </div>
                                </div>
                                <div class=\"d-flex justify-content-between mt-3\">
                                    <div class=\"text-center bg-light p-2 rounded\" style=\"flex: 1; margin-right: 5px;\">
                                        <p class=\"mb-0 text-muted\">Chambres</p>
                                        <h5 class=\"mb-0\">".$_hotel['chambres']."</h5>
                                    </div>
                                    <div class=\"text-center bg-light p-2 rounded\" style=\"flex: 1; margin-left: 5px;\">
                                        <p class=\"mb-0 text-muted\">Occupées</p>
                                        <h5 class=\"mb-0\">".$_hotel['reservations']."</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>";
                }
            ?>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>