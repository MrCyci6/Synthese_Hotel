<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chambres disponibles - Au-Tel 2 Lux</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/roomSelection.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
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
			<a class="navbar-brand fw-semibold d-flex flex-column ms-2" href="/home">
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

</nav>

<!-- Formulaire de recherche -->
<section class="container py-5">
	<h1 class="text-center mb-5 section-title">Chambres disponibles à <?= ($chambres['hotel_nom']) ?></h1>
	<div class="form-container mb-5">
		<form method="POST" class="d-flex flex-wrap gap-3 align-items-end">
			<input type="hidden" name="hotel" value="<?= $chambres['form_data']['id_hotel'] ?>">
			<div class="flex-fill">
				<label for="date-arrivee" class="form-label text-white">Arrivée</label>
				<input id="date-arrivee" name="date_arrive" type="text" class="form-control form-control-sm date-picker" placeholder="Sélectionnez une date" value="<?= ($chambres['form_data']['date_arrive']) ?>" required>
			</div>
			<div class="flex-fill">
				<label for="date-depart" class="form-label text-white">Départ</label>
				<input id="date-depart" name="date_depart" type="text" class="form-control form-control-sm date-picker" placeholder="Sélectionnez une date" value="<?= ($chambres['form_data']['date_depart']) ?>" required>
			</div>
			<div class="flex-fill">
				<button type="submit" class="btn btn-warning w-100">Rechercher</button>
			</div>
		</form>
	</div>

	<!-- Modale pour les erreurs -->
	<?php if (isset($_GET['error'])): ?>
		<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content error-modal">
					<div class="modal-header">
						<h5 class="modal-title" id="errorModalLabel">Erreur</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<?php
						if ($_GET['error'] === 'invalid_dates') {
							echo "La date d'arrivée doit être antérieure à la date de départ.";
						} elseif ($_GET['error'] === 'missing_data') {
							echo "Veuillez remplir tous les champs du formulaire.";
						}
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				let errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
					backdrop: 'static',
					keyboard: false
				});
				errorModal.show();
			});
		</script>
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
				<?php
				$date_arrive = $chambres['form_data']['date_arrive'] ?? null;
				$date_depart = $chambres['form_data']['date_depart'] ?? null;
				$id_hotel = $chambres['form_data']['id_hotel'] ?? null;
				$prix = $chambre['prix'] ?? null;
				$categorie = $chambre['categorie_nom'] ?? null;

				if (empty($date_arrive) || empty($date_depart) || !strtotime($date_arrive) || !strtotime($date_depart) || empty($id_hotel) || empty($prix) || empty($categorie)) {
					continue;
				}
				?>
				<div class="col-md-4 col-sm-12">
					<div class="card room-card h-100">
						<img src="<?= $chambre['image_url'] ?? '/images/img.png' ?>" class="card-img-top" alt="Chambre <?= ($chambre['categorie_nom']) ?>">
						<div class="card-body">
							<h5 class="card-title"><?= ($chambre['categorie_nom']) ?></h5>
							<p class="card-text">
								<i class="fas fa-euro-sign me-1"></i><strong>Prix :</strong> <?= ($chambre['prix']) ?> € par nuit<br>
								<i class="fas fa-bed me-1"></i><strong>Disponibilité :</strong> <?= ($chambre['chambres_disponibles']) ?> chambre(s)
							</p>
							<a href="reservation?hotel=<?= ($id_hotel) ?>&categorie=<?= urlencode($categorie) ?>&prix=<?= ($prix) ?>&date_arrive=<?= ($date_arrive) ?>&date_depart=<?= ($date_depart) ?>" class="btn btn-warning w-100">Réserver</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>

<!-- Footer -->
<footer class="text-center text-lg-start text-white pt-5 mt-auto footer">
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
	<div class="text-center py-3 footer-copyright">
		© 2024 Au-Tel 2 Lux. Tous droits réservés.
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Initialisation du calendrier pour la date d'arrivée
		const arriveePicker = flatpickr('#date-arrivee', {
			dateFormat: 'Y-m-d',
			minDate: 'today',
			locale: 'fr',
			defaultDate: '<?= htmlspecialchars($chambres['form_data']['date_arrive']) ?>',
			onChange: function(selectedDates, dateStr, instance) {
				if (selectedDates.length > 0) {
					departPicker.set('minDate', new Date(selectedDates[0].getTime() + 24 * 60 * 60 * 1000));
				}
			}
		});

		// Initialisation du calendrier pour la date de départ
		const departPicker = flatpickr('#date-depart', {
			dateFormat: 'Y-m-d',
			minDate: new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
			locale: 'fr',
			defaultDate: '<?= htmlspecialchars($chambres['form_data']['date_depart']) ?>',
			onChange: function(selectedDates, dateStr, instance) {
				if (selectedDates.length > 0) {
					arriveePicker.set('maxDate', new Date(selectedDates[0].getTime() - 24 * 60 * 60 * 1000));
				}
			}
		});
	});
</script>
</body>
</html>