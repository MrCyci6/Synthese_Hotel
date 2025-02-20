<div class="main-section flex-fill p-4 m-3 shadow-sm bg-white rounded-3">
	<h3 class="fw-bold">Paramètres du compte</h3>
	<p class="text-muted">Gérez vos informations personnelles et vos préférences ici.</p>
	<ul class="nav nav-tabs mt-3" id="settingsTabs" role="tablist">
		<li class="nav-item">
			<button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
				Général
			</button>
		</li>
		<li class="nav-item">
			<button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
				Sécurité
			</button>
		</li>
		<li class="nav-item">
			<button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab">
				Paiement
			</button>
		</li>
	</ul>
	<div class="tab-content mt-4" id="settingsTabsContent">
		<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
			<h5 class="fw-bold">Informations de base</h5>
			<div class="d-flex align-items-center mb-4">
				<i class="bi bi-person-circle fs-1 text-secondary me-3"></i>
				<button class="btn btn-outline-secondary">Modifier l'avatar</button>
			</div>
			<form action="dashboard.php?page=dashboard&view=settings" method="post">
				<div class="mb-3">
					<label class="form-label fw-bold">Nom</label>
					<input type="text" class="form-control" name="clientName" value="test" readonly>
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">Adresse e-mail</label>
					<input type="email" class="form-control" name="clientEmail" value="test" readonly>
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">Adresse</label>
					<div class="input-group d-flex align-items-center justify-content-between">
						<input type="text" class="form-control" name="clientAddress" id="clientAddress" value="test">
						<button type="submit" class="btn btn-primary d-none" id="saveAddressBtn">Enregistrer</button>
					</div>
				</div>
			</form>
		</div>
		<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
			<h5 class="fw-bold">Sécurité du compte</h5>

			<div class="mb-3">
				<label class="form-label fw-bold">Changer le mot de passe</label>
				<input type="password" class="form-control" placeholder="Nouveau mot de passe">
			</div>

			<button class="btn btn-danger">Mettre à jour le mot de passe</button>
		</div>
		<div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
			<h5 class="fw-bold">Gestion du paiement</h5>

			<div class="mb-3">
				<label class="form-label fw-bold">Moyen de paiement</label>
				<input type="text" class="form-control" placeholder="Ex: Carte Visa, PayPal...">
			</div>

			<div class="mb-3">
				<label class="form-label fw-bold">Derniers paiements</label>
				<ul class="list-group">
					<li class="list-group-item">Réservation #123 - 50€ - 02/03/2025</li>
					<li class="list-group-item">Réservation #124 - 75€ - 10/03/2025</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script>
    document.getElementById('clientAddress').addEventListener('input', function() {
        document.getElementById('saveAddressBtn').classList.remove('d-none');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
