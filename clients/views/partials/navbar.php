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
						<a class="nav-link" href="dashboard.php?page=logout"> Déconnexion <i class="bi bi-box-arrow-up-right m-2"></i></a>
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
						<a class="nav-link" href="dashboard.php?page=logout"><i class="bi bi-box-arrow-up-right p-2"></i> Déconnexion</a>
					</div>
				</div>
			</div>
		</div>
	</nav>