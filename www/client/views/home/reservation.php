<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation de réservation - AU-TEL 2 LUX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/home.css">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 px-4">
	<div class="container-fluid d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
			<a class="navbar-brand fw-semibold d-flex flex-column ms-2" href="home">
				AU-TEL 2 LUX
				<span class="fs-6">HÔTELS & RESORTS</span>
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="home#navBar">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="home#Bedroom-link">Nos hôtels</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="home#Service">Nos services</a>
				</li>
				<li class="nav-item">
					<a class="btn btn-outline-warning" href="home#Book-place">Réserver maintenant</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dashboard" id="userDropdown" role="button" aria-expanded="false">
						<i class="bi bi-person-circle fs-5 text-white"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Formulaire de réservation -->
<section class="container py-5">
	<h1 class="text-center mb-5 section-title">Confirmation de votre réservation</h1>

	<!-- Affichage des erreurs -->
	<?php if (!empty($data['error'])): ?>
		<div class="alert alert-danger text-center">
			<?php
			if ($data['error'] === 'login_required') {
				echo "Vous devez être connecté pour réserver. Veuillez vous <a href='login' class='alert-link'>connecter</a> ou créer un compte.";
			} elseif ($data['error'] === 'Données de réservation incomplètes.') {
				echo "Veuillez vérifier que toutes les informations de réservation sont complètes.";
			} elseif ($data['error'] === 'Dates de réservation invalides.') {
				echo "Les dates sélectionnées ne sont pas valides. Veuillez choisir des dates correctes.";
			} else {
				echo ($data['error']);
			}
			?>
		</div>
	<?php endif; ?>

	<!-- Résumé de la réservation -->
	<div class="card mb-5">
		<div class="card-body">
			<h5 class="card-title">Résumé de la réservation</h5>
			<div class="row g-3">
				<div class="col-md-6">
					<p class="card-text mb-2"><strong>Hôtel :</strong> <?= ($data['hotel_nom'] ?? 'Hôtel inconnu') ?></p>
					<p class="card-text mb-2"><strong>Catégorie :</strong> <?= ($data['categorie'] ?? 'Non spécifié') ?></p>
					<p class="card-text mb-2"><strong>Prix :</strong> <?= ($data['prix'] ?? '0') ?> € par nuit</p>
				</div>
				<div class="col-md-6">
					<p class="card-text mb-2"><strong>Arrivée :</strong> <?= ($data['date_arrive'] ?? 'Non spécifiée') ?></p>
					<p class="card-text mb-2"><strong>Départ :</strong> <?= ($data['date_depart'] ?? 'Non spécifié') ?></p>
					<p class="card-text mb-2"><strong>Durée :</strong> <?= ($data['duree'] ?? 'Non calculée') ?></p>
				</div>
			</div>
		</div>
	</div>

	<!-- Formulaire client -->
	<div class="form-container">
		<h5 class="mb-4">Informations de paiement</h5>
		<form action="confirm" method="POST" class="row g-3">
			<!-- Champs cachés -->
			<input type="hidden" name="hotel_id" value="<?= ($data['hotel_id'] ?? '') ?>">
			<input type="hidden" name="categorie" value="<?= ($data['categorie'] ?? '') ?>">
			<input type="hidden" name="prix" value="<?= ($data['prix'] ?? '') ?>">
			<input type="hidden" name="date_arrive" value="<?= ($data['date_arrive'] ?? '') ?>">
			<input type="hidden" name="date_depart" value="<?= ($data['date_depart'] ?? '') ?>">

			<!-- Informations de paiement (fictif) -->
			<div class="col-12">
				<label for="carte" class="form-label">Numéro de carte (fictif)</label>
				<input type="text" class="form-control" id="carte" name="carte" placeholder="1234 5678 9012 3456" required>
			</div>
			<div class="col-md-6">
				<label for="expiration" class="form-label">Date d'expiration</label>
				<input type="text" class="form-control" id="expiration" name="expiration" placeholder="MM/AA" required>
			</div>
			<div class="col-md-6">
				<label for="cvv" class="form-label">CVV</label>
				<input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
			</div>
			<!-- Bouton de soumission -->
			<div class="col-12 mt-4">
				<button type="submit" class="btn btn-warning w-100">Confirmer la réservation</button>
			</div>
		</form>
	</div>
</section>

<!-- Footer -->
<footer class="text-center text-lg-start text-white pt-5 mt-auto">
	<div class="container">
		<div class="row">
			<div class="col-md-4 mb-4">
				<div class="d-flex align-items-center mb-3">
					<svg class="text-warning me-2" xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
					<h5 class="mb-0">AU-TEL 2 LUX</h5>
				</div>
				<p>Hôtel 2 Luxe offre une expérience inégalée dans des destinations prestigieuses.</p>
			</div>
			<div class="col-md-4 mb-4">
				<h5>Suivez-nous</h5>
				<div class="d-flex justify-content-center justify-content-md-start gap-3">
					<a href="https://facebook.com" class="btn btn-outline-light btn-sm"><i class="fab fa-facebook-f"></i></a>
					<a href="https://youtube.com" class="btn btn-outline-light btn-sm"><i class="fab fa-youtube"></i></a>
					<a href="https://instagram.com" class="btn btn-outline-light btn-sm"><i class="fab fa-instagram"></i></a>
					<a href="https://twitter.com" class="btn btn-outline-light btn-sm"><i class="fab fa-twitter"></i></a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<h5>Contact</h5>
				<p class="mb-1">Email: contact@luxehotels.com</p>
				<p class="mb-1">Téléphone: +33 1 23 45 67 89</p>
				<p>Adresse: 123 Rue du Luxe, Paris, France</p>
			</div>
		</div>
	</div>
	<div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2024 Au-Tel 2 Lux. Tous droits réservés.
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>