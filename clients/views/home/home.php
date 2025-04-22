<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LUXE HOTELS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-white text-dark">
<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 px-4" id="navBar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo et icône -->
        <div class="d-flex align-items-center">
            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"></path>
                <path d="m9 16 .348-.240c1.465-1.013 3.84-1.013 5.304 0L15 16"></path>
                <path d="M8 7h.01"></path>
                <path d="M16 7h.01"></path>
                <path d="M12 7h.01"></path>
                <path d="M12 11h.01"></path>
                <path d="M16 11h.01"></path>
                <path d="M8 11h.01"></path>
                <path d="M10 22v-6.5m4 0V22"></path>
            </svg>
            <a class="navbar-brand fw-semibold d-flex flex-column ms-2" href="#navbarNav">
                HOTEL 2 LUXE
                <span class="fs-6">HOTELS & RESORTS</span>
            </a>
        </div>

        <!-- Bouton burger pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navigation -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#navBar">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Bedroom">Nos chambres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Service">Nos services</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info" href="#Book-place">Reserver maintenant</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- Choix du type de service -->
<header class="position-relative d-flex align-items-center justify-content-center text-center"
        style="height: 90vh; background: url('images/hotel-7885138_1280.jpg') center/cover no-repeat;">

    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-75"></div>

    <div class="position-relative text-white">
        <h1 class="display-4 fw-bold">Bienvenue à l'hôtel LE LUXE</h1>
        <p class="lead">Vous trouverez dans nos hôtels des offres alléchantes.</p>

        <div class="bg-black p-3 rounded d-inline-flex flex-wrap gap-2" id="Book-place">
            <!-- Liste des destinations -->
            <div>
                <label for="destination" class="form-label text-white">Destination</label>
                <select id="destination" class="form-select form-select-sm" required>
                    <option disabled selected>Où allez-vous ?</option>
                    <?php
                    $code="";
                    for($i =0;$i<3;$i++){
                       $code.=`<option value='$hotel_id_name[$i]['id']'>$hotel_id_name[$i]['nom']</option><br>`;
                    }
                    echo $code;
                    ?>
                </select>
            </div>

            <!-- Dates d'arrivée et de départ -->
            <div>
                <label for="date-arrivee" class="form-label text-white">Arrivée</label>
                <input id="date-arrivee" type="date" class="form-control form-control-sm" required>
            </div>
            <div>
                <label for="date-depart" class="form-label text-white">Départ</label>
                <input id="date-depart" type="date" class="form-control form-control-sm" required>
            </div>
            <?php

            ?>
            <!-- Nombre d'adultes -->
            <div>
                <label for="adults" class="form-label text-white">Nombres d'adultes</label>
                <select id="adults" class="form-select form-select-sm" required>
                    <option disabled selected>Choisir</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>

            <!-- Bouton de recherche -->
            <div class="d-flex align-items-end">
                <button class="btn btn-warning w-100">Rechercher</button>
            </div>
        </div>
    </div>
</header>


<!-- Les chambres disponibles -->
<section class="container text-center mt-5">
    <h2>Available Accommodations</h2>
    <p>Discover our carefully curated selection of luxury accommodations, each offering unique experiences and unparalleled comfort.</p>
</section>
<!-- Les chambres disponibles -->
<div class="container mt-5" id="Bedroom">
    <div class="row justify-content-around">

        <!-- Hôtel 1 -->

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel de luxe">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Le Prestige</h5>
                    <p class="fw-bold">📍 Paris, France</p>
                    <p class="card-text">🏨 Chambre: Deluxe</p>
                    <p class="card-text">💰 Prix: 150€ par nuit</p>
                    <p class="card-text">Un hôtel luxueux avec vue imprenable et service 5 étoiles.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Hôtel 2 -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel moderne">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Élégance</h5>
                    <p class="fw-bold">📍 Nice, France</p>
                    <p class="card-text">🏨 Chambre: Supérieure</p>
                    <p class="card-text">💰 Prix: 180€ par nuit</p>
                    <p class="card-text">Un cadre idyllique avec un spa et une piscine privée.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Hôtel 3 -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel romantique">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Belle Vue</h5>
                    <p class="fw-bold">📍 Lyon, France</p>
                    <p class="card-text">🏨 Chambre: Standard</p>
                    <p class="card-text">💰 Prix: 120€ par nuit</p>
                    <p class="card-text">Un hôtel charmant en plein cœur de la ville avec restaurant gastronomique.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-around">

        <!-- Hôtel 1 -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel de luxe">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Le Prestige</h5>
                    <p class="fw-bold">📍 Paris, France</p>
                    <p class="card-text">🏨 Chambre: Deluxe</p>
                    <p class="card-text">💰 Prix: 150€ par nuit</p>
                    <p class="card-text">Un hôtel luxueux avec vue imprenable et service 5 étoiles.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Hôtel 2 -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel moderne">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Élégance</h5>
                    <p class="fw-bold">📍 Nice, France</p>
                    <p class="card-text">🏨 Chambre: Supérieure</p>
                    <p class="card-text">💰 Prix: 180€ par nuit</p>
                    <p class="card-text">Un cadre idyllique avec un spa et une piscine privée.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <!-- Hôtel 3 -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="width: 100%;">
                <img src="Images/OIP.jpg" class="card-img-top" alt="Hôtel romantique">
                <div class="card-body">
                    <h5 class="card-title">Hôtel Belle Vue</h5>
                    <p class="fw-bold">📍 Lyon, France</p>
                    <p class="card-text">🏨 Chambre: Standard</p>
                    <p class="card-text">💰 Prix: 120€ par nuit</p>
                    <p class="card-text">Un hôtel charmant en plein cœur de la ville avec restaurant gastronomique.</p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- services de restoration  -->
<div class="container my-5" id="Service">
    <h2 class="text-center mb-4">Nos Services de Restauration</h2>

    <!-- Service 1 -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <img src="Images/chef-2585791_1280.jpg" class="img-fluid rounded" alt="Chef cuisinier préparant un plat">
        </div>
        <div class="col-md-6">
            <h4>Gastronomie Raffinée</h4>
            <p>Découvrez une cuisine exquise préparée par nos chefs étoilés, avec des ingrédients frais et locaux.</p>
        </div>
    </div>

    <!-- Service 2 -->
    <div class="row align-items-center mb-4 flex-md-row-reverse">
        <div class="col-md-6">
            <img src="Images/restaurant-449952_1280.jpg" class="img-fluid rounded" alt="Salle de restaurant élégante">
        </div>
        <div class="col-md-6">
            <h4>Restaurant Élégant</h4>
            <p>Profitez d’une ambiance luxueuse avec un service haut de gamme, idéal pour des dîners romantiques ou des repas d’affaires.</p>
        </div>
    </div>

    <!-- Service 3 -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <img src="Images/cafe-2265254_1280.jpg" class="img-fluid rounded" alt="Buffet petit-déjeuner">
        </div>
        <div class="col-md-6">
            <h4>Petit-Déjeuner Gourmet</h4>
            <p>Commencez votre journée avec un petit-déjeuner varié : viennoiseries, fruits frais, et options healthy.</p>
        </div>
    </div>
</div>
<?php
echo $hotel_id_name[0]["hotel_nom"];
?>
<!-- Footer -->
<footer class="text-center text-lg-start text-white" style="background-color: #2c3e50;">
    <div class="container d-flex justify-content-center py-4">
        <a href="#" class="btn btn-outline-light btn-lg mx-2">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="btn btn-outline-light btn-lg mx-2">
            <i class="fab fa-youtube"></i>
        </a>
        <a href="#" class="btn btn-outline-light btn-lg mx-2">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="btn btn-outline-light btn-lg mx-2">
            <i class="fab fa-twitter"></i>
        </a>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(43, 8, 219, 0.2);">
        © 2024 Luxe Hotels & Resorts. Tous droits réservés.
    </div>
</footer>

<?php
   echo $hotel_id_name;
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
