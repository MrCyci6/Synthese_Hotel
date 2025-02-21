<div class="main-section flex-fill p-3 m-3 shadow-lg d-flex flex-column">
	<div class="row g-3 mb-3 d-flex align-items-stretch flex-wrap">
		<div class="col-6 col-md-3 d-flex ">
			<div class="card p-2 p-md-3 bg-white border rounded-3 flex-fill">
				<div class="card-body">
					<h5 class="card-title">Taux d'occupation</h5>
					<p class="card-text fw-bold">
						<?= isset($occupancyRate) ? $occupancyRate . '%' : "Aucun séjour en cours" ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-6 col-md-3 d-flex">
			<div class="card p-2 p-md-3 bg-red text-white rounded-3 flex-fill">
				<div class="card-body">
					<h5 class="card-title">Total des consommations</h5>
					<p class="card-text fw-bold">
						<?= number_format($totalConsosAmount, 2, ',', ' ') ?> €
					</p>
				</div>
			</div>
		</div>
		<div class="col-6 col-md-3 d-flex">
			<div class="card p-2 p-md-3 bg-yellow text-white rounded-3 flex-fill">
				<div class="card-body">
					<h5 class="card-title">Jours restants avant la date de départ</h5>
					<p class="card-text fw-bold">
						<?= is_null($daysLeft) ? "Aucune réservation en cours" : ($daysLeft == 0 ? "Réservation terminée" : $daysLeft) ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-6 col-md-3 d-flex">
			<div class="card p-2 p-md-3 bg-orange text-white rounded-3 flex-fill">
				<div class="card-body">
					<h5 class="card-title">Date de départ</h5>
					<p class="card-text fw-bold">
						<?= $nextDeparture ?: "Aucune réservation en cours" ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="row g-3 flex-fill d-flex align-items-stretch">
		<div class="col-12 col-md-6 d-flex">
			<div class="card flex-fill">
				<div class="card-header text-center">
					Ajouter / Choisir des consommations
				</div>
				<div class="card-body">
					<form action="dashboard.php?page=dashboard&view=home" method="post">
						<div class="mb-3">
							<label for="reservationSelect" class="form-label">Sélectionnez votre réservation</label>
							<select class="form-select" id="reservationSelect" name="reservationSelect">
								<?php foreach ($ongoingReservations as $reservation): ?>
									<option value="<?= $reservation['id_sejour'] ?>">
										Séjour du <?= $reservation['date_debut'] ?> au <?= $reservation['date_fin'] ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mb-3">
							<label for="consoName" class="form-label">Nom de la consommation</label>
							<select class="form-select" id="consoName" name="consoName">
								<option value="">Sélectionnez une consommation</option>
								<?php foreach ($availableConsos as $cons): ?>
									<option value="<?= $cons['id_conso'] ?>">
										<?= $cons['denomination'] ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mb-3">
							<label for="consoQty" class="form-label">Quantité</label>
							<input type="number" class="form-control" id="consoQty" name="consoQty" placeholder="1" value="1">
						</div>
						<button type="submit" class="btn btn-primary">Ajouter</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 d-flex">
			<div class="card flex-fill">
				<div class="card-header text-center">
					Gérer mes consommations
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs" id="consommationTabs" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="enCours-tab" data-bs-toggle="tab" data-bs-target="#enCours" type="button" role="tab" aria-controls="enCours" aria-selected="true">
								En cours
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="historique-tab" data-bs-toggle="tab" data-bs-target="#historique" type="button" role="tab" aria-controls="historique" aria-selected="false">
								Historique
							</button>
						</li>
					</ul>
					<div class="tab-content mt-3" id="consommationTabsContent">
						<div class="tab-pane fade show active" id="enCours" role="tabpanel" aria-labelledby="enCours-tab">
							<?php if (!empty($currentConsos)): ?>
								<ul class="list-group">
									<?php foreach ($currentConsos as $conso): ?>
										<li class="list-group-item">
											<strong><?= $conso['conso_name'] ?></strong>
											(<?= $conso['date_conso'] ?>) –
											<?= $conso['nombre'] ?> unité(s)
											– Prix unitaire : <?= number_format($conso['unit_price'], 2, ',', ' ') ?> €
											– Total : <?= number_format($conso['prix_total'], 2, ',', ' ') ?> €
										</li>
									<?php endforeach; ?>
								</ul>
							<?php else: ?>
								<p>Aucune consommation en cours.</p>
							<?php endif; ?>
						</div>
						<div class="tab-pane fade overflow-auto" id="historique" role="tabpanel" aria-labelledby="historique-tab" style="max-height: 500px;">
							<?php if (!empty($historicalConsos)): ?>

								<?php
								/* Ici je vais commencer par regrouper toutes les conso par séjour en créeant un tableau à 3 clés :
								 date début, date fin, et le tableau complet des consos que je récup depuis Conso::getHistoricalConsumptionsByClient*/
								$groupedBySejour = [];
								foreach ($historicalConsos as $item) {
									$idSejour = $item['id_sejour'];
									if (!isset($groupedBySejour[$idSejour])) {
										$groupedBySejour[$idSejour] = [
											'date_debut' => $item['date_debut'],
											'date_fin'   => $item['date_fin'],
											'hotel'      => $item['hotel_name'],
											'consos'     => []
										];
									}
									$groupedBySejour[$idSejour]['consos'][] = $item;
								}
								?>

								<div class="accordion" id="historicalConsosAccordion">
									<?php $index = 0; ?>
									<?php foreach ($groupedBySejour as $data):
										/* Ensuite je peux facilement créer les drop down en accédant à chaque donnée nécessaire du tableau*/
										?>
										<div class="accordion-item">
											<h2 class="accordion-header" id="heading<?= $index ?>">
												<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
													Séjour à <?= $data['hotel'] ?> du <?= $data['date_debut'] ?> au <?= $data['date_fin'] ?>
												</button>
											</h2>
											<div id="collapse<?= $index ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $index ?>" data-bs-parent="#historicalConsosAccordion">
												<div class="accordion-body">
													<?php if (!empty($data['consos'])): ?>
														<ul class="list-group">
															<?php foreach ($data['consos'] as $conso): ?>
																<li class="list-group-item">
																	<strong><?= $conso['conso_name'] ?></strong>
																	(<?= $conso['date_conso'] ?>) –
																	<?= $conso['nombre'] ?> unité(s)
																	– Prix unitaire : <?= number_format($conso['unit_price'], 2, ',', ' ') ?> €
																	– Total : <?= number_format($conso['prix_total'], 2, ',', ' ') ?> €
																</li>
															<?php endforeach; ?>
														</ul>
													<?php else: ?>
														<p>Aucune consommation pour ce séjour.</p>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<?php $index++; ?>
									<?php endforeach; ?>
								</div>

							<?php else: ?>
								<p>Aucune consommation historique.</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>