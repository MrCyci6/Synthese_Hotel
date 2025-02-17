<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard Bootstrap</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
		<link rel="stylesheet" href="../styles/dashboard-global.css">
	</head>
	<body class="body w-100 h-100">
		<div class="container-fluid" style="overflow-x: hidden" >
			<div class="row flex-nowrap justify-content-center">
				<!-- Barre latérale -->
				<nav class="col-auto sidebar d-none d-lg-flex flex-column align-items-center justify-content-center min-vh-100">
					<ul class="nav flex-column p-0 m-0">
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="bi bi-layout-text-sidebar-reverse"></i></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="bi bi-heart"></i></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="bi bi-bell"></i></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="bi bi-cash-stack"></i></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="bi bi-gear"></i></a>
						</li>
					</ul>
				</nav>

				<div class="col mx-auto p-0 d-flex flex-column">
					<!-- Barre de navigation -->
					<nav class="navbar navbar-expand-lg navbar-light bg-white px-3">
						<div class="container-fluid">
							<a class="navbar-brand" href="#">Au Tel 2 Lux</a>
							<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
								<ul class="navbar-nav ms-auto">
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
							<button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
								<i class="bi bi-list"></i>
							</button>
							<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
								<div class="offcanvas-header">
									<h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Au Tel 2 Lux</h5>
									<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
								<div class="offcanvas-body d-flex flex-column align-items-center justify-content-center p-0">
									<ul class="nav flex-column p-0 m-0">
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
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-layout-text-sidebar-reverse"></i></a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-heart"></i></a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-bell"></i></a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-cash-stack"></i></a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-gear"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</nav>
					<div class="main-section flex-fill p-3 m-5">
						<div class="row g-3">
							<div class="col-md-3">
								<div class="card p-2 bg-white border rounded-3">
									<div class="card-body">
										<h5 class="card-title">Taux d'occupation</h5>
										<p class="card-text">10%</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-2 bg-red text-white rounded-3">
									<div class="card-body">
										<h5 class="card-title">Total des consommations</h5>
										<p class="card-text">25€</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-2 bg-yellow text-white rounded-3">
									<div class="card-body">
										<h5 class="card-title">Nombre de plaintes reçues</h5>
										<p class="card-text">0</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-2 bg-orange text-white rounded-3">
									<div class="card-body">
										<h5 class="card-title">Date de départ</h5>
										<p class="card-text">25/12/25</p>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card p-5 bg-white border rounded-3">
									<h5 class="card-title">Consos</h5>
									<p class="card-text">
										<canvas id="myChart" width="400" height="400">
										</canvas>
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card p-5 bg-white border rounded-3">
									<h5 class="card-title">Consos</h5>
									<p class="card-text">
										<canvas id="myChart" width="400" height="400">
										</canvas>
									</p>
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
