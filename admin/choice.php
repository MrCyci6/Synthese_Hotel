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

    <title>Gestion | Hotels</title>

    <link rel="stylesheet" href="./styles/choice.css">
    <script src="https://kit.fontawesome.com/c4352304cc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar px-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <svg style="color: rgb(37, 99, 235);" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel h-8 w-8 text-blue-600"><path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"></path><path d="m9 16 .348-.24c1.465-1.013 3.84-1.013 5.304 0L15 16"></path><path d="M8 7h.01"></path><path d="M16 7h.01"></path><path d="M12 7h.01"></path><path d="M12 11h.01"></path><path d="M16 11h.01"></path><path d="M8 11h.01"></path><path d="M10 22v-6.5m4 0V22"></path></svg>
                <h4 class="ms-2 mt-1 dt fw-bold">Au-Tel-2-Lux | Gestion</h4>
            </div>
            <div class="d-flex align-items-center">
                <?php 
                if($userId==ADMIN_ID)
                    echo "<a href=\"permissions.php\" class=\"text-decoration-none d-flex align-items-center justify-content-around text-secondary me-3\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield h-5 w-5\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"></path></svg>
                        <h5 class=\"ms-1 mt-1\">Gérer les permissions</h5>
                    </a>"
                ?>
                <a href="logout.php" class="text-decoration-none d-flex align-items-center justify-content-around text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-5 w-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
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
                                    <div class=\"bg-primary-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center\" style=\"width: 50px; height: 50px;\">
                                        <svg style=\"color: rgb(37, 99, 235);\"  xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-building2 h-6 w-6 text-blue-600\"><path d=\"M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z\"></path><path d=\"M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2\"></path><path d=\"M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2\"></path><path d=\"M10 6h4\"></path><path d=\"M10 10h4\"></path><path d=\"M10 14h4\"></path><path d=\"M10 18h4\"></path></svg>
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