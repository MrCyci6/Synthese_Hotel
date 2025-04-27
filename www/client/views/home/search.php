<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chambres disponibles - AU-TEL-2-LUX</title>
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
			<a class="navbar-brand fw-semibold d-flex flex-column ms-2" href="/info_hotels">
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
					<a class="nav-link" href="/info_hotels#navBar">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/info_hotels#Bedroom-link">Nos hôtels</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/info_hotels#Service">Nos services</a>
				</li>
				<li class="nav-item">
					<a class="btn btn-outline-info" href="/info_hotels#Book-place">Réserver maintenant</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/login" id="userDropdown" role="button" aria-expanded="false">
						<i class="bi bi-person-circle fs-5 text-white"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Formulaire de recherche -->
<section class="container py-5">
	<h1 class="text-center mb-5">Chambres disponibles à <?= $chambres[$id_hotel]['hotel_nom'] ?></h1>
	<div class="bg-black p-3 rounded mb-5">
		<form method="POST" class="d-flex flex-wrap gap-3 align-items-end">
			<!-- Hôtel (caché, car déjà sélectionné) -->
			<input type="hidden" name="hotel" value="<?= $chambres['form_data']['id_hotel'] ?>">
			<!-- Dates d'arrivée et de départ -->
			<div class="flex-fill">
				<label for="date-arrivee" class="form-label text-white">Arrivée</label>
				<input id="date-arrivee" name="arriver" type="date" class="form-control form-control-sm" value="<?= htmlspecialchars($chambres['form_data']['date_arrive']) ?>" required>
			</div>
			<div class="flex-fill">
				<label for="date-depart" class="form-label text-white">Départ</label>
				<input id="date-depart" name="depart" type="date" class="form-control form-control-sm" value="<?= htmlspecialchars($chambres['form_data']['date_depart']) ?>" required>
			</div>
			<!-- Bouton de recherche -->
			<div class="flex-fill">
				<button type="submit" class="btn btn-warning w-100">Rechercher</button>
			</div>
		</form>
	</div>

	<!-- Affichage des erreurs -->
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

	<!-- Chambres disponibles -->
	<div class="row g-4">
		<?php if (empty($chambres) || count($chambres) === 1): ?>
			<div class="col-12">
				<div class="alert alert-warning text-center">
					Aucune chambre disponible pour ces dates.
				</div>
			</div>
		<?php else: ?>
			<?php foreach ($chambres as $chambre): ?>
				<?php if (!is_array($chambre) || !isset($chambre['categorie_nom'])) continue; ?>
				<div class="col-md-4 col-sm-12">
					<div class="card h-100 shadow-sm">
						<img src="<?= $chambre['image_url'] ?? 'images/placeholder.jpg' ?>" class="card-img-top" alt="Chambre <?= $chambre['categorie_nom'] ?>">
						<div class="card-body">
							<h5 class="card-title"><?= $chambre['categorie_nom'] ?></h5>
							<p class="card-text">
								<strong>Prix :</strong> <?= $chambre['prix'] ?> € par nuit<br>
								<strong>Disponibilité :</strong> <?= $chambre['chambres_disponibles'] ?> chambre(s)
							</p>
							<a href="/reservation?hotel=<?= htmlspecialchars($chambres['form_data']['id_hotel']) ?>&categorie=<?= urlencode($chambre['categorie_nom']) ?>&prix=<?= htmlspecialchars($chambre['prix']) ?>&arriver=<?= htmlspecialchars($chambres['form_data']['date_arrive']) ?>&depart=<?= htmlspecialchars($chambres['form_data']['date_depart']) ?>" class="btn btn-primary">Réserver</a>						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>

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
					<h5 class="mb-0">Au-Tel-2-Lux</h5>
				</div>
				<p>Au-Tel-2-Lux offre une expérience inégalée dans des destinations prestigieuses.</p>
			</div>
			<!-- Liens sociaux -->
			<div class="col-md-4 mb-4">
				<h5>Suivez-nous</h5>
				<div class="d-flex justify-content-center justify-content-md-start gap-3">
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
		© 2024 HAu-Tel-2-Lux. Tous droits réservés.
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>