<div class="m-5">
    <div class="card shadow border-0 p-4">
            <div class="d-flex align-items-center mb-5">
                <svg style="color: #e6dc3f;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked"><path d="M10 2v8l3-3 3 3V2"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                <h5 class="card-title ms-2 mt-1">Factures disponibles</h5>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td class="text-secondary">#</td>
                        <td class="text-secondary">HOTEL</td>
                        <td class="text-secondary">CHAMBRE</td>
                        <td class="text-secondary">DÉBUT</td>
                        <td class="text-secondary">FIN</td>
                        <td class="text-secondary">ACTIONS</td>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        foreach($sejours as $sejour) {
                            echo '<tr>
                                <td>Facture'.$sejour['id_sejour'].'.pdf</td>
                                <td>'.$sejour['nom_hotel'].'</td>
                                <td>'.$sejour['numero_chambre'].'</td>
                                <td>'.$sejour['date_debut'].'</td>
                                <td>'.$sejour['date_fin'].'</td>
                                <td>
                                    <a href="room?hotel_id=$hotelId&book_id=" class="text-primary text-decoration-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #e6dc3f;" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                    </a>
                                </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>

            <nav class="d-flex justify-content-center">
                <ul class="pagination d-flex">
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Précédent</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link">..</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=1<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">1</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=2<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">2</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=3<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">3</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=4<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">4</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=5<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">5</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=6<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">6</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=7<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">7</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=8<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">8</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=9<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">9</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">10</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">11</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link">..</a></li>
                    <li class="page-item"><a style="color: #e6dc3f;" class="page-link" href="rooms?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Suivant</a></li>
                </ul>
            </nav>  
        </div>
    </div>
</div>

<div style="display: none;">
    <div id="bill" style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
        <h1 style="text-align:center;">Facture Au-Tel 2 Lux</h1>
        <hr style="margin:20px 0;">

        <h2>Informations Client</h2>
        <p><strong>Nom :</strong> LENOIR</p>
        <p><strong>Prénom :</strong> Cyriac</p>
        <p><strong>Email :</strong> cyriac@hotel.fr</p>
        <p><strong>Adresse :</strong> 60 rue d'Hérouville, Caen 14000, France</p>

        <h2 style="margin-top:30px;">Détails du Séjour</h2>
        <p><strong>Numéro de Séjour :</strong> 2</p>
        <p><strong>Date d'Arrivée :</strong> 25 avril 2025</p>
        <p><strong>Date de Départ :</strong> 28 avril 2025</p>

        <h2 style="margin-top:30px;">Résumé des Consommations</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;" border="1">
            <thead style="background-color: #f0f0f0;">
                <tr>
                    <th style="padding:8px;">Description</th>
                    <th style="padding:8px;">Quantité</th>
                    <th style="padding:8px;">Prix Unitaire</th>
                    <th style="padding:8px;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding:8px;">Petit Déjeuner</td>
                    <td style="padding:8px;">3</td>
                    <td style="padding:8px;">15€</td>
                    <td style="padding:8px;">45€</td>
                </tr>
                <tr>
                    <td style="padding:8px;">Service Blanchisserie</td>
                    <td style="padding:8px;">1</td>
                    <td style="padding:8px;">30€</td>
                    <td style="padding:8px;">30€</td>
                </tr>
            </tbody>
        </table>

        <h2 style="margin-top:30px;">Prix</h2>
        <p><strong>Prix de la chambre (3 nuits) :</strong> 300€</p>
        <p><strong>Total des consommations :</strong> 75€</p>

        <h2 style="margin-top:20px; text-align:right;">Total à Payer : <span style="color:#000;">375€</span></h2>

        <hr style="margin:30px 0;">
        <p style="text-align:center; font-size:12px;">Merci d'avoir choisi Au-Tel 2 Lux. Nous espérons vous revoir bientôt !</p>
    </div>
</div>

<script src="js/bills.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>