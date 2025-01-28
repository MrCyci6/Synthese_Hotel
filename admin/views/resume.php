        <!-- Content -->
        <div class="p-4">
            <!-- Stats -->
            <div class="row g-4">
                <!-- Booking -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Réservations</span>
                                <p class="fs-4 fw-semibold"><?= $reservationsCount ?></p>
                            </div>
                            <div class="bg-primary-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(37, 99, 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-6 w-6 text-blue-600"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Occupation rate -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Occupation</span>
                                <p class="fs-4 fw-semibold"><?= round(($occupedRoomsCount*100)/$roomsCount, 2) ?> %</p>
                            </div>
                            <div class=" rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(147, 51, 234, 0.2)">
                                <svg style="color: rgb(147, 51, 234);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-6 w-6 text-purple-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Daily average revenue -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Consommations</span>
                                <p class="fs-4 fw-semibold"><?= $consosCount ?></p>
                            </div>
                            <div class="bg-warning-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(234, 88, 12);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee"><path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Revenue -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-3 rounded-xl border-0 shadow">
                        <div class="d-flex flex-row align-items-center justify-content-around">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fs-6 text-secondary">Revenus</span>
                                <p class="fs-4 fw-semibold"><?= $sales ?> €</p>
                            </div>
                            <div class="bg-success-subtle rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg style="color: rgb(22, 163, 74);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-6 w-6 text-green-600"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recents -->
            <div class="row g-4 mt-2">
                <!-- Recents booking -->
                <div class="col-12 col-lg-6">
                    <div class="card p-3 border-0 rounded shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Dernières réservations</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <?php 
                                foreach($reservations as $reservation) {
                                    echo "<div class=\"bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center\">
                                        <div>
                                            <h5 class=\"mb-0 fs-6\">".$reservation['nom_user']." ".$reservation['prenom_user']."</h5>
                                        </div>
                                        <div>
                                            <h5 class=\"mb-0\">".$reservation['date_debut']."</h5>
                                            <span class=\"text-secondary\">".$reservation['nuits']." nuits</span>
                                        </div>
                                        <div>";

                                    if($reservation['now'] < $reservation['date_debut'])
                                        echo "<span style=\"border-radius: 15px;\" class=\"p-1 bg-success-subtle text-success\">Confirmée</span>";
                                    else if($reservation['now'] > $reservation['date_debut'] && $reservation['now'] < $reservation['date_fin'])
                                        echo "<span style=\"border-radius: 15px;\" class=\"p-1 bg-warning-subtle text-warning\">En cours</span>";
                                    else if($reservation['now'] > $reservation['date_fin'])
                                        echo "<span style=\"border-radius: 15px;\" class=\"p-1 bg-danger-subtle text-danger\">Terminée</span>";

                                    echo "</div>
                                    </div>";
                                }

                            ?>
                        </div>
                    </div>
                </div>

                <!-- Recents consumptions -->
                <div class="col-12 col-lg-6">
                    <div class="card p-3 border-0 rounded shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Dernières consommations</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <?php
                                foreach($consos as $conso) {
                                    echo "<div class= \"bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center \">
                                        <div>
                                            <h5 class= \"mb-0 fs-6 \">x".$conso['nombre']." ".$conso['conso']."</h5>
                                        </div>
                                        <div>
                                            <h5 class= \"mb-0 \">".$conso['date_conso']."</h5>
                                            <span class= \"text-secondary \">".$conso['nom_user']." ".$conso['prenom_user']."</span>
                                        </div>
                                        <div>
                                            <span style= \"border-radius: 15px; \" class= \"p-1 \">".$conso['prix']." €</span>
                                        </div>
                                    </div>";
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logs -->
            <div class="row g-4 mt-2">
                <div class="col-12">
                    <div class="card p-3 border-0 shadow">
                        <div>
                            <h2 class="fs-5 fw-semibold mb-4">Dernières activités</h2>
                        </div>
                        <div class="d-flex flex-column justify-content-between gap-3">
                            <?php
                                foreach($logs as $log) {
                                    echo "<div class=\"bg-body-secondary bg-opacity-25 p-2 rounded d-flex justify-content-between align-items-center\">
                                        <div>
                                            <h5 class=\"mb-0 fs-6\">".$log['nom_user']." ".$log['prenom_user']."</h5>
                                        </div>
                                        <div>
                                            <span class=\"text-secondary\">".$log['content']."</span>
                                        </div>
                                        <div>
                                        <span class=\"text-secondary\">".$log['date']."</span>
                                        </div>
                                    </div>";
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>