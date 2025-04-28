    <div class="p-4 mt-3">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-md-8">
                        <h1 class="py-3 fw-bold">Prix de nos chambres</h1>
                    </div>
                    <div class="col-6 col-md-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Changer Prix
                        </button>

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
                                            ID chambre : <input type="text" name="id_chambre"><br><br>
                                            Nouveau prix : <input type="number" step="1" name="new_price">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" id="btn-save" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    
                    <div class="card p-4 border-0 bt-3 shadow">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-secondary">#</td>
                                        <td class="text-secondary">DÉNOMINATION</td>
                                        <td class="text-secondary">PRIX</td>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                for ($i = 0; $i < $nbChambre; $i++) {
                                    $id=$i+1;
                                    echo "<tr><td>".$id."</td><td>".$infoChambre[$i]['chambre']."</td><td>".$infoChambre[$i]['prix']."</td></td></tr>";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>