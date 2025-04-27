<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Réservation confirmée - HÔTELS DE LUXE</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../styles/home.css">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black py-3 px-4" id="navBar">
	<div class="container-fluid d-flex justify-content-between align-items-center">
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
				HÔTEL 2 LUXE
				<span class="fs-6">HÔTELS & RESORTS</span>
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
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

<!-- Confirmation de réservation -->
<section class="container py-5">
	<h1 class="text-center mb-5">Réservation confirmée</h1>
	<div class="alert alert-success text-center">
		Votre réservation a été confirmée avec succès ! Numéro de réservation : <?= htmlspecialchars($_GET['reservation_id'] ?? 'N/A') ?>.
	</div>
	<div class="text-center">
		<a href="/info_hotels" class="btn btn-primary">Retour à l'accueil</a>
	</div>
</section>

<!-- Footer -->
<footer class="text-center text-lg-start text-white pt-5 mt-auto" style="background-color: #2c3e50;">
	<div class="container">
		<div class="row">
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
			<div class="col-md-4 mb-4">
				<h5>Contact</h5>
				<p class="mb-1">Email: contact@luxehotels.com</p>
				<p class="mb-1">Téléphone: +33 1 23 45 67 89</p>
				<p>Adresse: 123 Rue du Luxe, Paris, France</p>
			</div>
		</div>
	</div>
	<div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2024 Hôtel 2 Luxe. Tous droits réservés.
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>