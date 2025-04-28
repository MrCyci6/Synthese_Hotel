<div class="main-section flex-fill p-4 m-3 shadow-sm bg-white rounded-3">
	<h3 class="fw-bold fs-3 mb-3 text-dark">Mes Réservations</h3>
	<p class="text-muted fs-5 mb-3">Visualisez toutes vos réservations passées et en cours</p>

	<ul class="nav nav-tabs mt-3" id="reservationTabs" role="tablist">
		<li class="nav-item">
			<button class="nav-link active fs-5 px-3 py-1" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing" type="button" role="tab">
				En cours
			</button>
		</li>
		<li class="nav-item">
			<button class="nav-link fs-5 px-3 py-1" id="past-tab" data-bs-toggle="tab" data-bs-target="#past" type="button" role="tab">
				Passées
			</button>
		</li>
	</ul>

	<div class="tab-content mt-4" id="reservationTabsContent">
		<div class="tab-pane fade show active" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
			<?php if (!empty($ongoingReservations)): ?>
				<div class="row g-3">
					<?php foreach ($ongoingReservations as $reservation): ?>
						<div class="col-12 col-md-6">
							<div class="card border-0 shadow-sm rounded-3 bg-light">
								<div class="card-body p-3">
									<h5 class="card-title fw-semibold fs-4 text-primary"><?php echo ($reservation['hotel_name']); ?></h5>
									<p class="card-text fs-5 text-muted">
										Du <?php echo $reservation['date_debut']; ?> au <?php echo $reservation['date_fin']; ?><br>
										Statut : <span class="badge bg-primary fs-6 px-2 py-1">En cours</span><br>
										Total consommations : <?php echo number_format(Conso::getTotalConsommationsAmount($reservation['id_sejour']), 2, ',', ' '); ?> €
									</p>
									<div class="d-flex gap-2">
										<a href="details?id=<?php echo $reservation['id_sejour']; ?>" class="btn btn-outline-primary fs-6 px-3">Voir détails</a>
										<a href="facture?id=<?= $reservation["id_sejour"] ?>" class="btn btn-outline-success fs-6 px-3">Générer facture</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<p class="fs-5 text-muted">Aucune réservation en cours.</p>
			<?php endif; ?>
		</div>
		<div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
			<?php if (!empty($pastReservations)): ?>
				<div class="row g-3">
					<?php foreach ($pastReservations as $reservation): ?>
						<div class="col-12 col-md-6">
							<div class="card border-0 shadow-sm rounded-3 bg-light">
								<div class="card-body p-3">
									<h5 class="card-title fw-semibold fs-4 text-primary"><?php echo ($reservation['hotel_name']); ?></h5>
									<p class="card-text fs-5 text-muted">
										Hôtel : <?php echo ($reservation['hotel_name']); ?><br>
										Du <?php echo $reservation['date_debut']; ?> au <?php echo $reservation['date_fin']; ?><br>
										Statut : <span class="badge bg-secondary fs-6 px-2 py-1">Terminée</span><br>
										Total consommations : <?php echo number_format(Conso::getTotalConsommationsAmount($reservation['id_sejour']), 2, ',', ' '); ?> €
									</p>
									<div class="d-flex gap-2">
										<a href="details?id=<?php echo $reservation['id_sejour']; ?>" class="btn btn-outline-primary fs-6 px-3">Voir détails</a>
										<a href="facture?id=<?= $reservation["id_sejour"] ?>" class="btn btn-outline-success fs-6 px-3">Générer facture</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<p class="fs-5 text-muted">Aucune réservation passée.</p>
			<?php endif; ?>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>