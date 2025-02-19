<div class="container-fluid" style="overflow-x: hidden" >
	<div class="row flex-nowrap justify-content-center">
		<!-- Barre latérale -->
		<nav class="col-auto sidebar d-none d-lg-flex flex-column align-items-center justify-content-center min-vh-100">
			<ul class="nav flex-column p-0 m-0">
				<li class="nav-item">
					<a href="dashboard.php?page=dashboard&view=home" class="nav-link <?php echo ($view === 'home') ? 'active' : ''; ?>"><i class="bi bi-layout-text-sidebar-reverse"></i></a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=dashboard&view=wishlist" class="nav-link <?php echo ($view === 'wishlist') ? 'active' : ''; ?>"><i class="bi bi-heart"></i></a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=dashboard&view=notifications" class="nav-link <?php echo ($view === 'notifications') ? 'active' : ''; ?>"><i class="bi bi-bell"></i></a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=dashboard&view=payment" class="nav-link <?php echo ($view === 'payment') ? 'active' : ''; ?>" "><i class="bi bi-cash-stack"></i></a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=dashboard&view=settings" class="nav-link <?php echo ($view === 'settings') ? 'active' : ''; ?>"><i class="bi bi-gear"></i></a>
				</li>
			</ul>
		</nav>