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
							<a class="navbar-brand" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="m-2">
									<path d="M7 14C8.66 14 10 12.66 10 11C10 9.34 8.66 8 7 8C5.34 8 4 9.34 4 11C4 12.66 5.34 14 7 14ZM7 10C7.55 10 8 10.45 8 11C8 11.55 7.55 12 7 12C6.45 12 6 11.55 6 11C6 10.45 6.45 10 7 10ZM19 7H11V15H3V5H1V20H3V17H21V20H23V11C23 8.79 21.21 7 19 7ZM21 15H13V9H19C20.1 9 21 9.9 21 11V15Z" fill="black"/>
								</svg>
								Au Tel 2 Lux
							</a>
							<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
								<ul class="navbar-nav ms-auto">
									<li class="nav-item">
										<a class="nav-link" href="#">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">Support</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#"> Déconnexion <i class="bi bi-box-arrow-up-right m-2"></i></a>
									</li>
								</ul>
							</div>
							<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
								<i class="navbar-toggler-icon"></i>
							</button>
							<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
								<div class="offcanvas-header">
									<h5 class="offcanvas-title" id="sidebarOffcanvasLabel">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="m-2">
											<path d="M7 14C8.66 14 10 12.66 10 11C10 9.34 8.66 8 7 8C5.34 8 4 9.34 4 11C4 12.66 5.34 14 7 14ZM7 10C7.55 10 8 10.45 8 11C8 11.55 7.55 12 7 12C6.45 12 6 11.55 6 11C6 10.45 6.45 10 7 10ZM19 7H11V15H3V5H1V20H3V17H21V20H23V11C23 8.79 21.21 7 19 7ZM21 15H13V9H19C20.1 9 21 9.9 21 11V15Z" fill="white"/>
										</svg>
										Au Tel 2 Lux
									</h5>
									<button type="button" class="btn-close text-reset custom-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
								<div class="offcanvas-body d-flex flex-column align-items-center justify-content-center p-0">
									<ul class="nav flex-column p-0 m-0">
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-house m-2"></i>Home</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-heart m-2"></i>Réservations Favorites</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-bell m-2"></i>Notifications</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-cash-stack m-2"></i>Moyen de Réglements</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link"><i class="bi bi-gear m-2"></i>Paramètres</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-headset m-2"></i>Support</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-box-arrow-up-right m-2"></i> Déconnexion</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</nav>
					<div class="main-section flex-fill p-3 m-3">
						<div class="row g-3">
							<div class="col-md-3">
								<div class="card p-3 bg-white border rounded-3">
									<div class="card-body">
										<h5 class="card-title">Taux d'occupation</h5>
										<p class="card-text">10%</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 bg-red text-white rounded-3">
									<div class="card-body">
										<h5 class="card-title">Total des consommations</h5>
										<p class="card-text">25€</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 bg-yellow text-white rounded-3">
									<div class="card-body">
										<h5 class="card-title">Nombre de plaintes reçues</h5>
										<p class="card-text">0</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 bg-orange text-white rounded-3">
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
