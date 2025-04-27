<div class="main-section flex-fill p-4 m-3 shadow-sm bg-white rounded-3">
	<h3 class="fw-bold fs-3 mb-4 text-dark">Détails de la Réservation</h3>

	<?php if ($reservation): ?>
		<div class="card mb-3 border-0 shadow-sm rounded-3 bg-light">
			<div class="card-body p-3">
				<h4 class="card-title fw-semibold fs-4 text-primary"><?php echo htmlspecialchars($reservation['hotel_name']); ?></h4>
				<p class="card-text fs-5 text-muted">
					Période : Du <?php echo $reservation['date_debut']; ?> au <?php echo $reservation['date_fin']; ?><br>
					Statut : <span class="badge <?php echo $reservation['is_ongoing'] ? 'bg-primary' : 'bg-secondary'; ?> fs-6 px-2 py-1">
						<?php echo $reservation['is_ongoing'] ? 'En cours' : 'Terminée'; ?>
					</span>
				</p>
			</div>
		</div>

		<h4 class="fw-bold mt-4 mb-3 fs-4 text-dark">Consommations</h4>
		<?php if (!empty($consommations)): ?>
			<ul class="list-group list-group-flush">
				<?php foreach ($consommations as $conso): ?>
					<li class="list-group-item border-0 rounded-2 mb-2 bg-light p-2">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<strong class="fs-5"><?php echo htmlspecialchars($conso['conso_name']); ?></strong>
								<p class="mb-0 text-muted">
									(<?php echo $conso['date_conso']; ?>) –
									<?php echo $conso['nombre']; ?> unité(s) –
									Prix unitaire : <?php echo number_format($conso['unit_price'], 2, ',', ' '); ?> €
								</p>
							</div>
							<span class="fs-5 fw-semibold text-dark">
								<?php echo number_format($conso['prix_total'], 2, ',', ' '); ?> €
							</span>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<p class="mt-3 fs-5 fw-bold text-dark">
				Total des consommations : <?php echo number_format(Conso::getTotalConsommationsAmount($reservation['id_sejour']), 2, ',', ' '); ?> €
			</p>
		<?php else: ?>
			<p class="fs-5 text-muted">Aucune consommation enregistrée.</p>
		<?php endif; ?>

		<div class="d-flex gap-2 mt-3">
			<a href="?page=dashboard&view=reservations" class="btn btn-outline-secondary fs-6 px-3">Retour aux réservations</a>
			<button class="btn btn-outline-success fs-6 px-3">Générer facture</button>
		</div>
	<?php else: ?>
		<p class="fs-5 text-danger">Réservation non trouvée.</p>
	<?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>