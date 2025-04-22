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
                LUXE
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
                    <a class="nav-link" href="#Service">nos service</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info" href="#Book-place">Reserver maintenant</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- Choix du type de service -->
<form method="post" action="#">
<header class="position-relative d-flex align-items-center justify-content-center text-center"
        style="height: 90vh; background: url('Images/hotel-7885138_1280.jpg') center/cover no-repeat;">

    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-75"></div>

    <div class="position-relative text-white">
        <h1 class="display-4 fw-bold">Bienvenue à l'hôtel LE LUXE</h1>
        <p class="lead">Vous trouverez dans nos hôtels des offres alléchantes.</p>

        <div class="bg-black p-3 rounded d-inline-flex flex-wrap gap-2" id="Book-place">
            <!-- Liste des destinations -->
            <div>
                <label for="destination" class="form-label text-white">Destination</label>
                <select id="destination" class="form-select form-select-sm"  name="hotel" required>
                    <option disabled selected>Où allez-vous ?</option>
                    <?php
                    $code = '';
                    foreach ($info_hotel as $hotel) {
                        $id = htmlspecialchars($hotel['id']);
                        $nom = htmlspecialchars($hotel['nom']);
                        $code .= "<option value=\"$id\">$nom</option>";
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


            <!-- Bouton de recherche -->
            <div class="d-flex align-items-end">
                <button class="btn btn-warning w-100">Rechercher</button>
            </div>
        </div>
    </div>
</header>
</form>

<!-- Présentation de l'hôtel -->
<section class="container text-center mt-5">
    <h2>APERÇU DE NOS HÔTELS</h2>
    <p>Découvrez un aperçu de nos hôtels exceptionnels avec des vues sur les chambres, la réception et d'autres espaces.</p>
</section>

<!-- Carrousel d'images Bootstrap -->
<!-- Hôtel 1 -->
<div class="container mt-5">
    <h2 class="text-center mb-3">Hôtel 1</h2>
    <div id="hotelCarousel1" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Hotel1/img1.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Chambre de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel1/img2.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Réception de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel1/img3.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel1/img4.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel1" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</div>

<!-- Hôtel 2 -->
<div class="container mt-5">
    <h2 class="text-center mb-3">Hôtel 2</h2>
    <div id="hotelCarousel2" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Hotel2/img1.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Chambre de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel2/img2.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Réception de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel2/img3.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel2/img4.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel2" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel2" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</div>

<!-- Hôtel 3 -->
<div class="container mt-5">
    <h2 class="text-center mb-3">Hôtel 3</h2>
    <div id="hotelCarousel3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Hotel3/img1.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Chambre de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel3/img2.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Réception de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel3/img3.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel3/img4.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel3" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel3" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</div>

<!-- Hôtel 4 -->
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-3">Hôtel 4</h2>
    <div id="hotelCarousel4" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Hotel4/img1.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Chambre de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel4/img2.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Réception de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel4/img3.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel4/img4.jpg" class="d-block w-100 img-fluid" style="height: 400px; object-fit: cover;" alt="Vue extérieure de l'hôtel">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel4" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel4" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
