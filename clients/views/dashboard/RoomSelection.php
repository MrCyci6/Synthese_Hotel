<div class="main-section flex-fill p-4 m-3 shadow-sm bg-white rounded-3">
	<h3 class="fw-bold fs-3 mb-3 text-dark">Sélection des Chambres - <?php echo ($hotel_nom); ?></h3>
	<p class="text-muted fs-5 mb-4">Choisissez une chambre pour votre séjour du <?php echo $form_data['date_arrive']; ?> au <?php echo $form_data['date_depart']; ?></p>

	<?php if (!empty($chambres)): ?>
		<div class="row g-3">
			<?php foreach ($chambres as $chambre): ?>
				<div class="col-12 col-md-6">
					<div class="card border-0 shadow-sm rounded-3 bg-light">
						<div class="card-body p-3">
							<h5 class="card-title fw-semibold fs-4 text-primary"><?php echo ($chambre['categorie']); ?></h5>
							<p class="card-text fs-5 text-muted">
								Prix par nuit : <?php echo number_format($chambre['prix'], 2, ',', ' '); ?> €<br>
								Capacité : <?php echo $chambre['capacite']; ?> personne(s)<br>
								Disponibilité : <?php echo $chambre['disponible'] ? 'Disponible' : 'Non disponible'; ?>
							</p>
							<form action="/dashboard?page=dashboard&view=confirm_reservation" method="post">
								<input type="hidden" name="hotel_id" value="<?php echo $form_data['id_hotel']; ?>">
								<input type="hidden" name="categorie" value="<?php echo $chambre['categorie']; ?>">
								<input type="hidden" name="prix" value="<?php echo $chambre['prix']; ?>">
								<input type="hidden" name="date_arrive" value="<?php echo $form_data['date_arrive']; ?>">
								<input type="hidden" name="date_depart" value="<?php echo $form_data['date_depart']; ?>">
								<button type="submit" class="btn btn-outline-primary fs-6 px-3">Réserver</button>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="fs-5 text-muted">Aucune chambre disponible pour ces dates.</p>
	<?php endif; ?>

	<a href="/dashboard?page=dashboard&view=search" class="btn btn-outline-secondary fs-6 px-3 mt-3">Retour à la recherche</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>