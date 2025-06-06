<!DOCTYPE html>
<html lang="fr" data-bs-theme="<?= $userMode ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="./assets/styles/_root.scss">
    <link rel="stylesheet" href="./assets/styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <script src="./assets/js/darkmode.js"></script>

    <div class="sidebar d-flex flex-column border-end">
        <!-- Header -->
        <div class="container border-bottom d-flex justify-content-center align-items-center">
            <svg class="me-2" style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel h-8 w-8 text-blue-600"><path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"></path><path d="m9 16 .348-.24c1.465-1.013 3.84-1.013 5.304 0L15 16"></path><path d="M8 7h.01"></path><path d="M16 7h.01"></path><path d="M12 7h.01"></path><path d="M12 11h.01"></path><path d="M16 11h.01"></path><path d="M8 11h.01"></path><path d="M10 22v-6.5m4 0V22"></path></svg>
            <h4 class="text-center py-3 fw-bold">Au-Tel-2-Lux</h4>
        </div>

        <!-- Gestion -->
        <div class="container border-bottom p-2">
            <?php 
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]))
                    echo "<a href=\"users?hotel_id=".$hotelId."\" class=\"sidebar-link d-flex align-items-center mb-2 justify-content-center ".($selected=="users" ? "selected" : "")."\" style=\"border-radius: 15px;".($selected=="users" ? " color: rgb(37 99 235);" : "")."\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield h-5 w-5\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"></path></svg>
                        <h6 class=\"ms-2 mt-1\">Gestions utilisateurs</h6>
                    </a>";
            ?>

            <!-- Hotel list -->
            <select id="selectHotel" class="form-select mb-1 mt-1">
                <?php
                    foreach($hotels as $_hotelId => $hotelData) {
                        echo "<option value=\"$_hotelId\" ".($hotelId == $_hotelId ? "selected" : "").">".$hotelData['name']."</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Modules -->
        <div class="container">
            <a href="dashboard?hotel_id=<?= $hotelId ?>" class="sidebar-link mb-2 mt-2 <?= $selected=="dashboard" ? "selected" : "" ?>" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart3 h-5 w-5"><path d="M3 3v18h18"></path><path d="M18 17V9"></path><path d="M13 17V5"></path><path d="M8 17v-3"></path></svg>
                <span>Tableau de bord</span>
            </a>
            <?php
            
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]) || isset($hotels[$hotelId]["perms"][2])) {
                    echo '<a href="rooms?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="rooms" ? "selected" : "").'" style="border-radius: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-5 w-5"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>                
                        <span>Réservations</span>
                    </a>';
                }
            
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]) || isset($hotels[$hotelId]["perms"][4])) {
                    echo '<a href="rooms-price?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="rooms-price" ? "selected" : "").'" style="border-radius: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag h-5 w-5"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>                
                        <span>Prix - chambres</span>
                    </a>';
                }
            
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]) || isset($hotels[$hotelId]["perms"][3])) {
                    echo '<a href="consums?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="consums" ? "selected" : "").'" style="border-radius: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils h-5 w-5"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>                
                        <span>Consommations</span>
                    </a>';
                }
            
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]) || isset($hotels[$hotelId]["perms"][5])) {
                    echo '<a href="consums-price?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="consums-price" ? "selected" : "").'" style="border-radius: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag h-5 w-5"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>                
                        <span>Prix - conso</span>
                    </a>';
                }
            
                if(User::isAdmin($userId) || isset($hotels[$hotelId]["perms"][1]) || isset($hotels[$hotelId]["perms"][7])) {
                    echo '<a href="logs?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="logs" ? "selected" : "").'" style="border-radius: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-clock"><path d="M16 22h2a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg>
                        <span>Activité</span>
                    </a>';
                }
            
                if(User::isAdmin($userId)) {
                    echo '<a href="support?hotel_id='.$hotelId.'" class="sidebar-link mb-2 mt-2 '.($selected=="support" ? "selected" : "").'" style="border-radius: 15px;">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headset-icon lucide-headset"><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/></svg>
                       <span>Support</span>
                    </a>';
                }            
            ?>
        </div>
    </div>

    <div class="content bg-body-tertiary">
        <!-- Header -->
        <div class="topbar d-flex align-items-center justify-content-between px-4">
            <div class="container d-flex flex-column">    
                <h5 class="mb-0"><?= $hotels[$hotelId]['name'] ?></h5>
                <span class="text-secondary"><?= $hotels[$hotelId]['class'] ?></span>
            </div>
            <div>
                <span id="mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon-star-icon lucide-moon-star"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9"/><path d="M20 3v4"/><path d="M22 5h-4"/></svg>
                </span>
            </div>
            <div class="container d-flex justify-content-end">    
                <span class="me-2"><?= $user['nom']." ".$user['prenom'];?></span>
                <a href="logout"><svg style="color: rgb(75, 85, 99);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-5 w-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg></a>
            </div>  
        </div>