<div class="container-fluid vh-100 overflow-hidden" style="overflow-x: hidden">
	<div class="row h-100 flex-nowrap">
		<!-- Barre latérale -->
		<nav class="col-auto sidebar d-none d-lg-flex flex-column align-items-center justify-content-center min-vh-100">
			<ul class="nav flex-column p-0 m-0">
				<li class="nav-item">
					<a href="dashboard" class="nav-link <?php echo ($view === 'home') ? 'active' : ''; ?>"><i class="bi bi-layout-text-sidebar-reverse"></i></a>
				</li>
				<li class="nav-item">
					<a href="search" class="nav-link <?php echo ($view === 'search') ? 'active' : ''; ?>" "><i class="bi bi-search"></i></a>
				</li>
				<li class="nav-item">
					<a href="wishlist" class="nav-link <?php echo ($view === 'wishlist') ? 'active' : ''; ?>"><i class="bi bi-heart"></i></a>
				</li>
				<li class="nav-item">
					<a href="notifications" class="nav-link <?php echo ($view === 'notifications') ? 'active' : ''; ?>"><i class="bi bi-bell"></i></a>
				</li>
				<li class="nav-item">
					<a href="settings" class="nav-link <?php echo ($view === 'settings') ? 'active' : ''; ?>"><i class="bi bi-gear"></i></a>
				</li>
			</ul>
		</nav>