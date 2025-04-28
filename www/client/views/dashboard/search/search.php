<div class="main-section flex-fill p-3 m-3 shadow-lg bg-white d-flex flex-column h-100">
	<section class="d-flex flex-fill align-items-center justify-content-center text-center position-relative" style="border-radius: 0.625rem; background: white url('assets/images/image.webp') no-repeat center;">
		<div class="position-absolute top-0 start-0 w-100 h-100 opacity-50"></div>
		<div class="position-relative text-white m-2">
			<h1 class="display-4 fw-bold">Trouvez votre meilleur séjour</h1>
			<p class="lead">Gérez vos préférences de réservation en quelques clics</p>
			
			<form method="post" class="bg-dark p-3 rounded my-4" id="searchForm">
				<input type="hidden" name="action" value="search_rooms">
				<div class="row g-2 align-items-center">
					<div class="col-12 col-md">
						<div class="input-group input-group-sm" id="hotelInputGroup">
							<select name="location" id="hotelSelect" class="form-select form-select-sm" required>
								<option value="">Choisissez un hôtel</option>
								<?php foreach ($hotelList as $hotel): ?>
									<option value="<?= $hotel['id_hotel'] ?>" data-category="<?= $hotel['classe'] ?>">
										<?= ($hotel['nom_hotel']) ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span class="input-group-text d-none" id="hotelCategoryDisplay"></span>
						</div>
					</div>
					<div class="col-12 col-md">
						<input type="text" class="form-select form-select-sm" name="date_arrive" id="date_arrive" placeholder="Date d'arrivée" required />
					</div>
					<div class="col-12 col-md">
						<input type="text" class="form-select form-select-sm" name="date_depart" id="date_depart" placeholder="Date de départ" required />
					</div>
					<div class="col-12 col-md-auto">
						<button type="submit" class="btn btn-primary btn-sm w-100">Rechercher</button>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>
	const dateArrivePicker = flatpickr("#date_arrive", {
		minDate: "today",
		dateFormat: "Y-m-d",
		locale: "fr",
		onChange: function(selectedDates, dateStr) {
			if (selectedDates.length) {
				dateDepartPicker.set("minDate", dateStr);
			}
		}
	});

	const dateDepartPicker = flatpickr("#date_depart", {
		minDate: "today",
		dateFormat: "Y-m-d",
		locale: "fr"
	});

	const hotelSelect = document.getElementById('hotelSelect');
	const hotelCategoryDisplay = document.getElementById('hotelCategoryDisplay');
	const searchForm = document.getElementById('searchForm');

	hotelSelect.addEventListener('change', function() {
		const selectedOption = hotelSelect.options[hotelSelect.selectedIndex];
		if (!selectedOption.value || selectedOption.text.includes("Choisissez")) {
			hotelCategoryDisplay.classList.add('d-none');
		} else {
			const category = selectedOption.getAttribute('data-category') || '';
			hotelCategoryDisplay.textContent = 'Classe : ' + category;
			hotelCategoryDisplay.classList.remove('d-none');
		}
	});

	// Prevent form submission if required fields are empty
	searchForm.addEventListener('submit', function(event) {
		const hotel = document.getElementById('hotelSelect').value;
		const dateArrive = document.getElementById('date_arrive').value;
		const dateDepart = document.getElementById('date_depart').value;

		if (!hotel || !dateArrive || !dateDepart) {
			event.preventDefault();
			alert('Veuillez remplir tous les champs : hôtel, date d\'arrivée, et date de départ.');
		}
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>