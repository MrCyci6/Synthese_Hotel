        <!-- Content -->
        <div class="p-4 mt-3">
            <!-- Main Content -->
            <div class="container-fluid p-2">

                <div class="d-flex justify-content-between mb-4">
                    <div class="d-flex gap-3 w-50">
                        <div class="w-75">
                            <form action="rooms">
                                <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                                <input type="text" name="search" class="form-control" placeholder="Chercher une réservation">
                            </form>
                        </div>
                        <div>
                            <button class="btn btn-outline-secondary">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                    <span>Filtres</span>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">
                            <div class="d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                <span>Nouvelle réservation</span>
                            </div>
                        </button>
                    </div>
                </div>
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="text-secondary">#</td>
                            <td class="text-secondary">CLIENT</td>
                            <td class="text-secondary">CATÉGORIE</td>
                            <td class="text-secondary">DÉBUT</td>
                            <td class="text-secondary">FIN</td>
                            <td class="text-secondary">STATUT</td>
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

                                echo "<td>".$reservation['total']." €</td>
                                    <td>
                                        <div class=\"d-flex align-items-center gap-3\">
                                            <a href=\"rooms?hotel_id=$hotelId&action=edit&room_id=".$reservation['id_sejour']."\" class=\"text-primary text-decoration-none\">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-pencil\"><path d=\"M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z\"/><path d=\"m15 5 4 4\"/></svg>
                                            </a>
                                            <a href=\"rooms?hotel_id=$hotelId&action=delete&room_id=".$reservation['id_sejour']."\" class=\"text-danger text-decoration-none\">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-trash-2\"><path d=\"M3 6h18\"/><path d=\"M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6\"/><path d=\"M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2\"/><line x1=\"10\" x2=\"10\" y1=\"11\" y2=\"17\"/><line x1=\"14\" x2=\"14\" y1=\"11\" y2=\"17\"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <nav class="d-flex justify-content-center">
                    <ul class="pagination d-flex">
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?>">Précédent</a></li>
                        <li class="page-item"><a class="page-link">..</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=2">2</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=3">3</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=4">4</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=5">5</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=6">6</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=7">7</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=8">8</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=9">9</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10">10</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10">11</a></li>
                        <li class="page-item"><a class="page-link">..</a></li>
                        <li class="page-item"><a class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?>">Suivant</a></li>
                    </ul>
                </nav>
            </div>
                
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>