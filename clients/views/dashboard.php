<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard Bootstrap</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="../styles/dashboard-global.css">
</head>
<body class="body">

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 fixed-top w-100">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Au Tel 2 Lux</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Support</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">My Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="bi bi-box-arrow-up-right"></i></a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Section principale -->
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 position-relative p-5" >
	<div class="main-section p-5 w-100 min-vh-70">
		<div class="row g-3">
			<div class="col-md-3">
				<div class="card p-4 bg-white border rounded-3"></div>
			</div>
			<div class="col-md-3">
				<div class="card p-4 bg-danger text-white rounded-3"></div>
			</div>
			<div class="col-md-3">
				<div class="card p-4 bg-warning text-white rounded-3"></div>
			</div>
			<div class="col-md-3">
				<div class="card p-4 bg-warning text-white rounded-3"></div>
			</div>

			<div class="col-md-6">
				<div class="card p-5 bg-white border rounded-3"></div>
			</div>
			<div class="col-md-6">
				<div class="card p-5 bg-white border rounded-3"></div>
			</div>

			<div class="col-md-6">
				<div class="card p-5 bg-white border rounded-3"></div>
			</div>
			<div class="col-md-6">
				<div class="card p-5 bg-white border rounded-3"></div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
