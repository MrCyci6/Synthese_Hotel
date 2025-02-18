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
								<div class="offcanvas-body d-flex flex-column p-0 align-items-center justify-content-center">
									<ul class="nav flex-column p-0 m-0 my-auto w-100 justify-content-center align-items-center">
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-house m-2"></i> Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-heart m-2"></i> Réservations Favorites</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-bell m-2"></i> Notifications</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-cash-stack m-2"></i> Moyen de Réglements</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-gear m-2"></i> Paramètres</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="bi bi-headset m-2"></i> Support</a>
										</li>
									</ul>
									<div class="d-flex flex-row justify-content-center w-100">
										<a class="nav-link" href="#"><i class="bi bi-box-arrow-up-right p-2"></i> Déconnexion</a>
									</div>
								</div>
							</div>
						</div>
					</nav>
					<div class="main-section flex-fill p-3 m-3 shadow-lg d-flex flex-column">
						<div class="row g-3 mb-3 d-flex align-items-stretch flex-wrap">
							<div class="col-6 col-md-3 d-flex ">
								<div class="card p-2 p-md-3 bg-white border rounded-3 flex-fill">
									<div class="card-body">
										<h5 class="card-title">Taux d'occupation</h5>
										<p class="card-text">10%</p>
									</div>
								</div>
							</div>
							<div class="col-6 col-md-3 d-flex">
								<div class="card p-2 p-md-3 bg-red text-white rounded-3 flex-fill">
									<div class="card-body">
										<h5 class="card-title">Total des consommations</h5>
										<p class="card-text">25€</p>
									</div>
								</div>
							</div>
							<div class="col-6 col-md-3 d-flex">
								<div class="card p-2 p-md-3 bg-yellow text-white rounded-3 flex-fill">
									<div class="card-body">
										<h5 class="card-title">Nombre de plaintes reçues</h5>
										<p class="card-text">0</p>
									</div>
								</div>
							</div>
							<div class="col-6 col-md-3 d-flex">
								<div class="card p-2 p-md-3 bg-orange text-white rounded-3 flex-fill">
									<div class="card-body">
										<h5 class="card-title">Date de départ</h5>
										<p class="card-text">25/12/25</p>
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
