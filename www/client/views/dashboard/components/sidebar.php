<div class="container-fluid vh-100 overflow-hidden" style="overflow-x: hidden">
	<div class="row h-100 flex-nowrap">
		<!-- Barre latérale -->
		<nav class="col-auto sidebar d-none d-lg-flex flex-column align-items-center justify-content-center min-vh-100">
			<ul class="nav flex-column p-0 m-0">
				<li class="nav-item">
					<a href="dashboard" class="nav-link <?php echo ($module === 'home') ? 'active' : ''; ?>"><i class="bi bi-layout-text-sidebar-reverse"></i></a>
				</li>
				<li class="nav-item">
					<a href="search" class="nav-link <?php echo ($module === 'search') ? 'active' : ''; ?>"><i class="bi bi-search"></i></a>
				</li>
				<li class="nav-item">
					<a href="reservations" class="nav-link <?php echo ($module === 'reservations' || $module === 'details') ? 'active' : ''; ?>"><i class="bi bi-book"></i></a>
				</li>
				<li class="nav-item">
					<a href="settings" class="nav-link <?php echo ($module === 'settings') ? 'active' : ''; ?>"><i class="bi bi-gear"></i></a>
				</li>
				<li class="nav-item">
					<a href="logout" class="nav-link"><i class="bi bi-box-arrow-right"></i></a>
				</li>
			</ul>
		</nav>