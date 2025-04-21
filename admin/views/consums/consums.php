<div class="p-4 mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="py-3 fw-bold">Récapitulatif consommations</h1>
            </div>
        </div>

        <div class="row g-4">

            <!-- Search -->
            <div class="card p-3 border-0 shadow d-flex flex-row align-items-center justify-content-between">
                <div class="w-75">
                    <form method="GET">
                        <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Chercher une consommation">
                            <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                        </div>
                    </form>
                </div>
                <div>  
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter Conso Client
                    </button>
                </div>
            </div>
    
            <div class="card p-4 border-0 bt-3 shadow">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <td class="text-secondary">#</td>
                            <td class="text-secondary">CLIENT</td>
                            <td class="text-secondary">CONSOMMATION</td>
                            <td class="text-secondary">NOMBRE</td>
                            <td class="text-secondary">PRIX UNIT.</td>
                            <td class="text-secondary">PRIX</td>
                            <td class="text-secondary">DATE</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($consommations as $consommation) {
                            echo "<tr>
                                <td>".$consommation['id_cc']."</td>
                                <td>".$consommation['prenom_user']." ".$consommation['nom_user']."</td>
                                <td>".$consommation['conso']."</td>
                                <td>".$consommation['nombre']."</td>
                                <td>".$consommation['prix_unit']."</td>
                                <td>".$consommation['prix']."</td>
                                <td>".$consommation['date_conso']."</td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination d-flex">
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Précédent</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=1<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">1</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=2<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">2</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=3<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">3</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=4<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">4</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=5<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">5</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=6<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">6</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=7<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">7</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=8<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">8</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=9<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">9</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">10</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">11</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="consums?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Suivant</a></li>
                        </ul>
                    </nav>  
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modification prix</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <div class="container">
                        Dénomination :
                        <select id="menu" name="menu">
                            <?php
                                foreach($allConsommations as $consommation){
                                    echo "<option value='".$consommation["id_conso"]."'>".$consommation["denomination"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <br><br>
                    Quantité : <input type="number" step="1" name="quantite">
                    <br><br>
                    Numéro séjour :
                    <select id="sejour" name="sejour">
                        <?php
                            foreach($allSejours as $sejour){
                                echo "<option value='".$sejour['id_sejour']."'>".$sejour['id_sejour']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" id="btn-save" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>