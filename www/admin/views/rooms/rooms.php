        <!-- Content -->
        <div class="p-4 mt-3">
            <div class="container-fluid">
                <!-- Main Content -->
                <div class="row g-4">
                    <!-- Header -->
                    <div class="d-flex align-items-center mb-2">
                        <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked"><path d="M10 2v8l3-3 3 3V2"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                        <h5 class="card-title ms-2 mt-1">Gestion des réservations</h5>
                    </div>

                    <!-- Search -->
                    <div class="card shadow border-0">
                        <div>
                            <div class="d-flex justify-content-between mb-4 h-100 align-items-center">
                                <div class="d-flex gap-3 w-50">
                                    <div class="w-100">
                                        <form method="GET">
                                            <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control" placeholder="Chercher une réservation">
                                                <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filtreModal">
                                            <div class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                                <span>Filtres</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- List -->
                    <div class="card shadow border-0 p-4"> 
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td class="text-secondary">#</td>
                                    <td class="text-secondary">CLIENT</td>
                                    <td class="text-secondary">CATÉGORIE</td>
                                    <td class="text-secondary">DÉBUT</td>
                                    <td class="text-secondary">FIN</td>
                                    <td class="text-secondary">STATUT</td>
                                    <td class="text-secondary">PAIEMENT</td>
                                    <td class="text-secondary">MONTANT</td>
                                    <td class="text-secondary">ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($reservations as $reservation) {
                                        echo "<tr>
                                            <td>".$reservation['id_sejour']."</td>
                                            <td>".$reservation['nom_user']." ".$reservation['prenom_user']."</td>
                                            <td>".$reservation['categorie']."</td>
                                            <td>".$reservation['date_debut']."</td>
                                            <td>".$reservation['date_fin']."</td>";
                                        echo "";
                                        if($reservation['now'] < $reservation['date_debut'])
                                            echo "<td><span class=\"badge bg-success-subtle text-success rounded-pill fw-medium\">Confirmée</span></td>";
                                        else if($reservation['now'] > $reservation['date_debut'] && $reservation['now'] < $reservation['date_fin'])
                                            echo "<td><span class=\"badge bg-warning-subtle text-warning rounded-pill fw-medium\">En cours</span></td>";
                                        else if($reservation['now'] > $reservation['date_fin'])
                                            echo "<td><span class=\"badge bg-danger-subtle text-danger rounded-pill fw-medium\">Terminée</span></td>";

                                        if($reservation['due'] <= $reservation['paiement'])
                                            echo "<td><span class=\"badge bg-success-subtle text-success rounded-pill fw-medium\">Payé</span></td>";
                                        else
                                            echo "<td><span class=\"badge bg-danger-subtle text-danger rounded-pill fw-medium\">Impayé</span></td>";

                                        echo "<td>".$reservation['due']." €</td>
                                            <td>
                                                <a href=\"room?hotel_id=$hotelId&book_id=".$reservation['id_sejour']."\" class=\"text-primary text-decoration-none\">
                                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-pencil\"><path d=\"M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z\"/><path d=\"m15 5 4 4\"/></svg>
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination d-flex">
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Précédent</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=1<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">1</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=2<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">2</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=3<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">3</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=4<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">4</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=5<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">5</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=6<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">6</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=7<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">7</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=8<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">8</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=9<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">9</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">10</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">11</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Suivant</a></li>
                            </ul>
                        </nav>  
                    </div>
                </div>
            </div>       
        </div>
    </div>

<!-- Filtre modal -->
<div class="modal fade" id="filtreModal" tabindex="-1" aria-labelledby="filtreModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <div class="modal-title d-flex align-items-center gap-2">
                    <div class="bg-success-subtle p-2 rounded-circle d-flex align-items-center">    
                        <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sliders-horizontal"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
                    </div>
                    <h1 class="fs-5">Filtres des réservations</h1>
                </div>
            </div>
            <form action="rooms">
                <input type="hidden" name="action" value="filtre">
                <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">

                <div class="modal-body border-0 d-flex flex-row gap-4 flex-wrap">
                    <div class="d-flex gap-5">
                        <div class="d-flex flex-column">
                            <label for="start_date" class="form-label">Date début</label>
                            <input class="form-date" type="date" name="start_date" id="start_date">
                        </div>

                        <div class="d-flex flex-column">
                            <label for="end_date" class="form-label">Date Fin</label>
                            <input class="form-date" type="date" name="end_date" id="end_date">
                        </div>
                    </div>

                    <div class="d-flex gap-5">
                        <div class="d-flex flex-column">
                            <label for="start_price" class="form-label">Prix minimum</label>
                            <div class="input-group">
                                <input class="form-control form-control-sm" name="start_price" type="number" value="0">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <label for="end_price" class="form-label">Prix maximum</label>
                            <div class="input-group">
                                <input class="form-control form-control-sm" name="end_price" type="number" value="63720">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 mt-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Filtrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="./assets/js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>