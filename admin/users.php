<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Projet/admin/libs/database.php';    

    $databaseManager = new DatabaseManager();

    // Session checker
    if(!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }
    $userId = $_SESSION['id'];
    $statement = $databaseManager->preparedQuery("SELECT nom, prenom FROM users WHERE id_user=?", [$userId]);
    $res = $statement->fetch();
    $userFirstname = $res['prenom'];
    $userLastname = $res['nom'];

    // Permissions checker
    if($userId != ADMIN_ID) {
        //header('Location: https://hotel.local/');
        echo "TODO: non admin, redirection hotel.local";
        exit();
    }

    // Get table page
    $tablePage = $_GET['page'];
    if(!isset($tablePage) || empty($tablePage)) $tablePage = 1;
    $tableStep = 10;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion | Utilisateurs</title>

    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="./styles/users.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="sidebar d-flex flex-column border-end">
        <!-- Header -->
        <div class="container border-bottom d-flex justify-content-center align-items-center">
            <svg class="me-2" style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel h-8 w-8 text-blue-600"><path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"></path><path d="m9 16 .348-.24c1.465-1.013 3.84-1.013 5.304 0L15 16"></path><path d="M8 7h.01"></path><path d="M16 7h.01"></path><path d="M12 7h.01"></path><path d="M12 11h.01"></path><path d="M16 11h.01"></path><path d="M8 11h.01"></path><path d="M10 22v-6.5m4 0V22"></path></svg>
            <h4 class="text-center py-3 fw-bold">Au-Tel-2-Lux</h4>
        </div>

        <!-- Gestion -->
        <div class="container border-bottom p-2">
            <a href="permissions.php" class="d-flex align-items-center mb-2 justify-content-center selected" style="border-radius: 15px; color: rgb(37 99 235);">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-5 w-5"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                <h6 class="ms-2 mt-1">Gestions utilisateurs</h6>
            </a>

            <!-- Hotel list -->
            <select id="selectHotel" class="form-select mb-1 mt-1">
                <?php
                    // Get hotels informations
                    $statement = $databaseManager->preparedQuery(
                        "SELECT id_hotel, nom FROM hotel;", []
                    );
                    $hotels = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach($hotels as $hotel) {
                        echo "<option value=\"".$hotel['id_hotel']."\">".$hotel['nom']."</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Modules -->
        <div class="container">
            <a href="panel.php?hotel_id=1" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart3 h-5 w-5"><path d="M3 3v18h18"></path><path d="M18 17V9"></path><path d="M13 17V5"></path><path d="M8 17v-3"></path></svg>
                <span>Tableau de bord</span>
            </a>
            <a href="rooms.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-5 w-5"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>                
                <span>Réservations</span>
            </a>
            <a href="rooms-price.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag h-5 w-5"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>                
                <span>Prix - chambres</span>
            </a>
            <a href="consums.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils h-5 w-5"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>                
                <span>Consommations</span>
            </a>
            <a href="consums-price.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag h-5 w-5"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>                
                <span>Prix - conso</span>
            </a>
            <a href="discounts.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
                <span>Promotions</span>
            </a>
            <a href="logs.php" class="mb-2 mt-2" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-clock"><path d="M16 22h2a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg>
                <span>Activité</span>
            </a>
        </div>
    </div>

    <div class="content bg-body-tertiary">
        <!-- Header -->
        <div class="topbar d-flex align-items-center justify-content-between px-4" style="background-color: white;">
            <div class="container d-flex flex-column">    
                <h5 class="mb-0">Administration</h5>
                <span class="text-secondary">Général</span>
            </div>    
            <div class="container d-flex justify-content-end">    
                <span class="me-2"><?php echo $userLastname." ".$userFirstname;?></span>
                <a href="logout.php"><svg style="color: rgb(75, 85, 99);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-5 w-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg></a>
            </div>  
        </div>

        <!-- Content -->
        <div class="p-4">
            <div class="container row g-4">
                <!-- Header -->
                <div class="d-flex align-items-center mb-2">
                    <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <h5 class="card-title ms-2 mt-1">Gestion des utilisateurs</h5>
                </div>
                <!-- Search -->
                <div class="card p-4 border-0">
                    <form method="GET" action="users.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Chercher un utilisateur (cyriac.lenoir@isen-ouest.yncrea.fr)">
                            <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                        </div>
                    </form>
                    <?php
                        $search = $_GET['search'];
                        if(isset($search)) {
                            if(empty($search)) {
                                echo "<span class=\"mt-3 text-danger\">Utilisateur introuvable : $search</span>";
                            } else {
                                $statement = $databaseManager->preparedQuery(
                                    "SELECT id_user, nom, prenom, email FROM users 
                                    WHERE email=? OR nom=? OR prenom=?;",
                                    [$search, $search, $search]
                                );
                                $users = $statement->fetchAll(PDO::FETCH_ASSOC);
                                if(!$users) {
                                    echo "<span class=\"mt-3 text-danger\">Utilisateur introuvable : $search</span>";
                                } else {
                                    foreach($users as $user) {
                                        echo "<div class=\"row g-4 ms-1 mt-1\">
                                            <div class=\"col-1 p-2 bg-body-secondary fw-bold\">".$user['id_user']."</div>
                                            <div class=\"col-3 p-2 bg-body-secondary\">".$user['nom']." ".$user['prenom']."</div>
                                            <div class=\"col-5 p-2 bg-body-secondary\">".$user['email']."</div>
                                            <div class=\"col-3 p-2 bg-body-secondary\">
                                                <a title=\"Permissions\" href=\"permissions-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                    <svg class=\"text-success\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"/></svg>
                                                </a>
                                                <a title=\"Modifer\" href=\"edit-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                    <svg class=\"text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-user-round-pen\"><path d=\"M2 21a8 8 0 0 1 10.821-7.487\"/><path d=\"M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z\"/><circle cx=\"10\" cy=\"8\" r=\"5\"/></svg>
                                                </a>
                                                <a  title=\"Bannir\" href=\"ban-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                    <svg class=\"text-warning\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m4.9 4.9 14.2 14.2\"/></svg>
                                                </a>
                                                <a title=\"Supprimer\" href=\"delete-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                    <svg class=\"text-danger\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-x\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>
                                                </a>
                                            </div>
                                        </div>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <!-- List -->
                <div class="card p-4 border-0 bt-3">
                    <!-- Pages -->
                    <!-- <div class="row g-4">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div>
                                <a href="users.php?page=<?php echo $tablePage==1 ? 1 : $tablePage-1;?>" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                                </a>
                                <span class="fw-semibold"><?php 
                                    if($tablePage==1) 
                                        echo "0 - $tableStep";
                                    else
                                        echo $tablePage*$tableStep-2*$tableStep." - ".$tablePage*$tableStep-1*$tableStep;
                                ?></span>
                            </div>
                            <div>
                                <span class="fw-bold fs-5">Page: <?php echo $tablePage;?></span>
                            </div>
                            <div>
                                <span class="fw-semibold"><?php echo $tablePage*$tableStep." - ".$tablePage*$tableStep+$tableStep;?></span>
                                <a href="users.php?page=<?php echo $tablePage+1;?>" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $statement = $databaseManager->preparedQuery(
                                    "SELECT id_user, nom, prenom, email FROM users WHERE id_user BETWEEN ? AND ?",
                                    [($tablePage == 1 ? 1 : $tablePage*$tableStep-$tableStep), $tablePage*$tableStep]
                                );
                                $users = $statement->fetchAll(PDO::FETCH_ASSOC);

                                foreach($users as $user) {
                                    echo "<tr>
                                        <th scope=\"row\">".$user['id_user']."</th>
                                        <td>".$user['nom']." ".$user['prenom']."</td>
                                        <td>".$user['email']."</td>
                                        <td>
                                            <a title=\"Permissions\" href=\"permissions-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-success\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"/></svg>
                                            </a>
                                            <a title=\"Modifer\" href=\"edit-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-user-round-pen\"><path d=\"M2 21a8 8 0 0 1 10.821-7.487\"/><path d=\"M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z\"/><circle cx=\"10\" cy=\"8\" r=\"5\"/></svg>
                                            </a>
                                            <a  title=\"Bannir\" href=\"ban-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-warning\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m4.9 4.9 14.2 14.2\"/></svg>
                                            </a>
                                            <a title=\"Supprimer\" href=\"delete-user.php?user_id=".$user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-danger\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-x\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination d-flex">
                            <li class="page-item"><a class="page-link" href="users.php?page=<?php echo $tablePage==1 ? 1 : $tablePage-1;?>">Précédent</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=2">2</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=3">3</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=4">4</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=5">5</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=6">6</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=7">7</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=8">8</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=9">9</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=10">10</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=10">11</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=<?php echo $tablePage+1;?>">Suivant</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>