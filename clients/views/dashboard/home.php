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
						<?= $daysLeft ?: "Aucune réservation en cours" ?>
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
					<form>
						<div class="mb-3">
							<label for="consoName" class="form-label">Nom de la consommation</label>
							<input type="text" class="form-control" id="consoName" placeholder="Ex: Boisson, Snack...">
						</div>
						<div class="mb-3">
							<label for="consoQty" class="form-label">Quantité</label>
							<input type="number" class="form-control" id="consoQty" placeholder="1">
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
							<p>Liste des consommations en cours...</p>
						</div>
						<div class="tab-pane fade" id="historique" role="tabpanel" aria-labelledby="historique-tab">
							<p>Historique des consommations passées...</p>
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