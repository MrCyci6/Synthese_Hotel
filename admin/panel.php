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

    <title>Tableau de bord</title>

    <link rel="stylesheet" href="./styles/dashboard.css">
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
            <a class="d-flex align-items-center mb-2 justify-content-center" style="border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-5 w-5"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                <h6 class="ms-3 mt-1">Gestion permissions</h6>
            </a>

            <select id="selectHotel" class="form-select mb-1 mt-1">
                <option selected>Sélectionner un hotel</option>
                <option value="1">Hotel de Caen</option>
                <option value="2">Hotel de Brest</option>
                <option value="3">Hotel de Paris</option>
                <option value="3">Hotel de Nantes</option>
            </select>
        </div>
        <!-- Modules -->
        <div class="container">
            <a href="#" class="mb-2 mt-2 selected" style="border-radius: 15px;">
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
            <a href="redeems.php" class="mb-2 mt-2" style="border-radius: 15px;">
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
                <h5 class="mb-0">Hotel de caen</h5>
                <span class="text-secondary">Standard</span>
            </div>    
            <div class="container d-flex justify-content-end">    
                <span class="me-2">Super Admin</span>
                <a class="logout.php"><svg style="color: rgb(75, 85, 99);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out h-5 w-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg></a>
            </div>  
        </div>

        <!-- Content -->
        <div class="p-4">
            <!-- Stats -->
            <div class="row g-4">
                <!-- Booking -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Réservations</span>
                                <p class="fs-4 fw-semibold">10</p>
                            </div>
                            <div class="bg-primary-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(37, 99, 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-6 w-6 text-blue-600"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Revenue -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Revenus</span>
                                <p class="fs-4 fw-semibold">14789€</p>
                            </div>
                            <div class="bg-success-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(22, 163, 74);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-6 w-6 text-green-600"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Occupation rate -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Occupation</span>
                                <p class="fs-4 fw-semibold">30%</p>
                            </div>
                            <div class=" rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(147, 51, 234, 0.2)">
                                <svg style="color: rgb(147, 51, 234);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-6 w-6 text-purple-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Daily average revenue -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Moy. jour</span>
                                <p class="fs-4 fw-semibold">137€</p>
                            </div>
                            <div class="bg-warning-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(234, 88, 12);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-6 w-6 text-orange-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recents -->
            <div class="row g-4 mt-2">
                <!-- Recents booking -->
                <div class="col-12 col-lg-6">
                    <div class="card p-3 border-0 rounded-xl shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Réservations récentes</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">LENOIR Cyriac</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">3 nuits</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px;" class="p-1 bg-success-subtle text-success">Confirmée</span>
                                </div>
                            </div>

                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">LENOIR Cyriac</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">3 nuits</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px; color: rgb(234, 88, 12);" class="p-1 bg-warning-subtle">En cours</span>
                                </div>
                            </div>

                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">LENOIR Cyriac</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">3 nuits</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px;" class="p-1 bg-success-subtle text-success">Confirmée</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recents consumptions -->
                <div class="col-12 col-lg-6">
                    <div class="card p-3 border-0 rounded-xl shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Consommations récentes</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">x3 Caffé gourmand</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">LENOIR Cyriac</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px;" class="p-1">14.59€</span>
                                </div>
                            </div>

                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">x3 Caffé gourmand</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">LENOIR Cyriac</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px;" class="p-1">14.59€</span>
                                </div>
                            </div>
                            
                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">x3 Caffé gourmand</h5>
                                </div>
                                <div>
                                    <h5 class="mb-0">15-02-2025</h5>
                                    <span class="text-secondary">LENOIR Cyriac</span>
                                </div>
                                <div>
                                    <span style="border-radius: 15px;" class="p-1">14.59€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-12">
                    <div class="card p-3 border-0 shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Activité récente</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">Super Admin</h5>
                                </div>
                                <div>
                                    <span class="text-secondary">Consommation(MODIFICATION): caffé gourmand - 10.99€ -> 5.99€</span>
                                </div>
                                <div>
                                <span class="text-secondary">22-01-2025 17:01:36</span>
                                </div>
                            </div>
                            
                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">Super Admin</h5>
                                </div>
                                <div>
                                    <span class="text-secondary">Permission(AJOUT): [+] LENOIR Cyriac - Module chambre</span>
                                </div>
                                <div>
                                <span class="text-secondary">22-01-2025 16:59:03</span>
                                </div>
                            </div>

                            <div class="bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fs-6">LENOIR Cyriac</h5>
                                </div>
                                <div>
                                    <span class="text-secondary">Connexion: 127.0.0.1</span>
                                </div>
                                <div>
                                <span class="text-secondary">22-01-2025 16:50:51</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>