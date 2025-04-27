<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Au-Tel-2-Lux</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../styles/home.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100">
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
			<a class="navbar-brand fw-semibold d-flex flex-column ms-2" href="#">
                AU-TEL-2-LUX
				<span class="fs-6">HÔTELS & RESORTS</span>
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
					<a class="nav-link" href="#Bedroom-link">Nos hôtels</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#Service">Nos services</a>
				</li>
				<li class="nav-item">
					<a class="btn btn-outline-info" href="#Book-place">Réserver maintenant</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="login" id="userDropdown" role="button" aria-expanded="false">
						<i class="bi bi-person-circle fs-5 text-white"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Choix du type de service -->
<header class="position-relative d-flex align-items-center justify-content-center text-center"
        style="height: 90vh; background: url('images/hotel.jpg') center/cover no-repeat;">
	<div class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-75"></div>
	<div class="position-relative text-white">
		<h1 class="display-4 fw-bold">Bienvenue à AU-TEL-2-LUX</h1>
		<p class="lead">Découvrez des offres exceptionnelles dans nos hôtels de prestige.</p>
		<div class="bg-black p-3 rounded" id="Book-place">
			<form action="selection" method="POST" class="d-flex flex-wrap gap-3 align-items-end">
				<!-- Liste des destinations -->
				<div class="flex-fill">
					<label for="destination" class="form-label text-white">Destination</label>
					<select id="destination" name="hotel" class="form-select form-select-sm" required>
						<option disabled selected>Où allez-vous ?</option>
						<?php foreach ($hotel_id_name as $hotel): ?>
							<option value="<?= htmlspecialchars($hotel['id']) ?>"><?= htmlspecialchars($hotel['nom']) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<!-- Dates d'arrivée et de départ -->
				<div class="flex-fill">
					<label for="date-arrivee" class="form-label text-white">Arrivée</label>
					<input id="date-arrivee" name="arriver" type="date" class="form-control form-control-sm" required>
				</div>
				<div class="flex-fill">
					<label for="date-depart" class="form-label text-white">Départ</label>
					<input id="date-depart" name="depart" type="date" class="form-control form-control-sm" required>
				</div>
				<!-- Bouton de recherche -->
				<div class="flex-fill">
					<button type="submit" class="btn btn-warning w-100">Rechercher</button>
				</div>
			</form>
		</div>
	</div>
</header>

<?php if (isset($_GET['error'])): ?>
	<div class="alert alert-danger text-center">
		<?php
		if ($_GET['error'] === 'invalid_dates') {
			echo "La date d'arrivée doit être antérieure à la date de départ.";
		} elseif ($_GET['error'] === 'missing_data') {
			echo "Veuillez remplir tous les champs du formulaire.";
		}
		?>
	</div>
<?php endif; ?>

<!-- Nos hôtels -->
<section class="container text-center mt-5" id="Bedroom-link">
	<h2>Nos Hôtels Disponibles</h2>
	<p>Découvrez notre sélection d'hôtels de luxe, chacun offrant des expériences uniques et un confort exceptionnel.</p>
</section>
<div class="container mt-5" id="Bedroom">
	<div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<?php foreach ($hotels as $index => $hotel): ?>
				<div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
					<div class="d-flex justify-content-center">
						<div class="card" style="max-width: 400px;">
							<img src="images/OIP.jpg" class="card-img-top" alt="Hôtel <?= htmlspecialchars($hotel['nom']) ?>">
							<div class="card-body">
								<h5 class="card-title"><?= htmlspecialchars($hotel['nom_hotel']) ?></h5>
								<p class="fw-bold">📍 <?= htmlspecialchars($hotel['localisation'] ?? 'Non précisé') ?></p>
								<p class="card-text">🏨 Catégorie : <?= htmlspecialchars($hotel['classe']) ?></p>
								<p class="card-text">💰 Prix : À partir de <?= htmlspecialchars($hotel['prix_min'] ?? '120') ?>€ par nuit</p>
								<p class="card-text">Un hôtel de luxe offrant confort et services haut de gamme.</p>
								<a href="/search/hotel/<?= $hotel['id_hotel'] ?>/dates/<?= date('Y-m-d') ?>_<?= date('Y-m-d', strtotime('+1 day')) ?>" class="btn btn-primary">Voir plus</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Précédent</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Suivant</span>
		</button>
	</div>
</div>

<!-- Services de restauration -->
<div class="container my-5" id="Service">
	<h2 class="text-center mb-5">Nos Services de Restauration</h2>
	<div class="row g-4">
		<?php foreach ($services as $service): ?>
			<div class="col-md-4 col-sm-12">
				<div class="card h-100 shadow-sm">
					<img src="<?= htmlspecialchars($service['image_url'] ?? 'images/placeholder.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($service['nom']) ?>">
					<div class="card-body">
						<h4 class="card-title"><?= htmlspecialchars($service['nom']) ?></h4>
						<p class="card-text"><?= htmlspecialchars($service['description']) ?></p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white pt-5 mt-auto" style="background-color: #2c3e50;">
	<div class="container">
		<div class="row">
			<!-- Logo et description -->
			<div class="col-md-4 mb-4">
				<div class="d-flex align-items-center mb-3">
					<svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
					<h5 class="mb-0">HÔTEL 2 LUXE</h5>
				</div>
				<p>Hôtel 2 Luxe offre une expérience inégalée dans des destinations prestigieuses.</p>
			</div>
			<!-- Liens sociaux -->
			<div class="col-md-4 mb-4">
				<h5>Suivez-nous</h5>
				<div class="d-flex justify-content-center justify-content-md-start gap-3">
					<!-- À remplacer par vos vrais liens -->
					<a href="https://facebook.com" class="btn btn-outline-light btn-sm">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="https://youtube.com" class="btn btn-outline-light btn-sm">
						<i class="fab fa-youtube"></i>
					</a>
					<a href="https://instagram.com" class="btn btn-outline-light btn-sm">
						<i class="fab fa-instagram"></i>
					</a>
					<a href="https://twitter.com" class="btn btn-outline-light btn-sm">
						<i class="fab fa-twitter"></i>
					</a>
				</div>
			</div>
			<!-- Contact -->
			<div class="col-md-4 mb-4">
				<h5>Contact</h5>
				<p class="mb-1">Email: contact@luxehotels.com</p>
				<p class="mb-1">Téléphone: +33 1 23 45 67 89</p>
				<p>Adresse: 123 Rue du Luxe, Paris, France</p>
			</div>
		</div>
	</div>
	<!-- Copyright -->
	<div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2024 Au-Tel-2-Lux. Tous droits réservés.
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>