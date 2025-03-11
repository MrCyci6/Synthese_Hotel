<div class="container mt-4">
        <h2 class="mb-4">Modifier la Réservation</h2>
        <div class="card p-3 border-0 shadow">
            <form action="room">
                <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                <input type="hidden" name="book_id" value="<?= $bookId ?>">
                <input type="hidden" name="action" value="edit">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom du Client</label>
                        <input type="text" class="form-control" value="<?= $reservation['nom_user'] . " " . $reservation['prenom_user']?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $reservation['email_user']?>" disabled>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Hôtel</label>
                        <select class="form-select" disabled>
                            <option selected><?= $reservation['nom_hotel'] ?></option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Catégorie</label>
                        <select name="categorie" class="form-select">
                            <?php
                                foreach($categories as $categorie) {
                                    echo "<option value=\"".$categorie['id_categorie']."\" ".($categorie['id_categorie'] == $reservation['id_categorie'] ? "selected" : "").">".$categorie['categorie']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date d'Arrivée</label>
                        <input name="date_start" type="date" class="form-control" value="<?= $reservation['date_debut'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de Départ</label>
                        <input name="date_end" type="date" class="form-control" value="<?= $reservation['date_fin'] ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Numéro de la chambre</label>
                        <input type="number" class="form-control" value="<?= $reservation['numero_chambre'] ?>" disabled>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant à payer</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" value="<?= $reservation['total'] ?>" disabled>
                            <span class="input-group-text">€</span>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant payé</label>
                        <div class="input-group mb-3">
                            <input type="number" name="paiement" class="form-control" value="<?= $reservation['paiement'] ?? 0 ?>">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <div class="d-flex align-items-center gap-2">    
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-5 w-5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                            <span>Supprimer</span>
                        </div>
                    </button>
                    <div>
                        <a href="rooms?hotel_id=<?= $hotelId ?>" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

                    
    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header border-0">
                    <div class="modal-title d-flex align-items-center gap-2">
                        <div class="bg-danger-subtle p-2 rounded-circle d-flex align-items-center">    
                            <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                        </div>
                        <h1 class="fs-5">Supprimer la réservation</h1>
                    </div>
                </div>
                <div class="modal-body border-0">
                    <span>Êtes-vous sûr de vouloir supprimer cette réservation ?</span><br>
                    <span>Cette action est irréversible.</span>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="rooms?action=delete&hotel_id=<?= $hotelId ?>&book_id=<?= $bookId?>" class="btn btn-danger">Supprimer la réservation</a>
                </div>
            </div>
        </div>
    </div>
                    


    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>