<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Connexion Client</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light vh-100">
<section id="login" class="d-flex align-items-center justify-content-center min-vh-100">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<h2 class="card-title text-center mb-4">Connexion</h2>
						<?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
						<form action="../../controllers/login.php" method="POST" id="login-form" autocomplete="off">
							<div class="mb-3">
								<label for="email" class="form-label">Email :</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">Mot de passe :</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-check mb-3">
								<input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
								<label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
							</div>
							<button type="submit" id="btn-login" class="btn btn-primary btn-lg w-100">Se connecter</button>
							<div class="text-center mt-3">
								<a href="#" data-bs-toggle="modal" data-bs-target="#forgetModal">Mot de passe oublié ?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="forgetModal" tabindex="-1" aria-labelledby="forgetModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="forgetModalLabel">Récupération du mot de passe</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<p>Entrez votre adresse email</p>
				<input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off" placeholder="Email">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-primary">Récupérer</button>
			</div>
		</div>
	</div>
</div>

<footer id="footer" class="mt-5"></footer>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        passwordField.type = document.getElementById('showPassword').checked ? 'text' : 'password';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
