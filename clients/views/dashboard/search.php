<div class="main-section flex-fill p-3 m-3 shadow-lg bg-white d-flex flex-column h-100">
	<section class="search-section d-flex flex-fill align-items-center justify-content-center text-center position-relative" style="min-height: 80vh; border-radius: 0.625rem; background: white url('../../styles/image.webp') no-repeat center;">
		<div class="position-absolute top-0 start-0 w-100 h-100 opacity-50"></div>

		<div class="position-relative text-white m-2">
			<h1 class="display-4 fw-bold">Trouvez votre meilleur séjour</h1>
			<p class="lead">Gérez vos préférences de réservation en quelques clics</p>
			<form action="search.php" method="get" class="bg-dark p-3 rounded my-4">
				<div class="row g-2 align-items-stretch">
					<div class="col-12 col-md">
						<input
								type="text"
								class="form-control form-control-sm"
								name="location"
								placeholder="Trouver votre hôtel"
								required
						/>
					</div>
					<div class="col-12 col-md">
						<input
								type="text"
								class="form-control form-control-sm"
								name="dates"
								placeholder="Sélectionnez les dates"
								required
						/>
					</div>
					<div class="col-12 col-md">
						<input
								type="text"
								class="form-control form-control-sm"
								name="category"
								placeholder="Catégorie"
								required
						/>
					</div>
					<div class="col-12 col-md-auto">
						<button type="submit" class="btn btn-warning btn-sm w-100">
							Search
						</button>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>