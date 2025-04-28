<div class="container-fluid mt-4">
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
                        <select class="form-select" disabled>
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
                            <input type="number" class="form-control" value="<?= $reservation['due'] ?>" disabled>
                            <span class="input-group-text">€</span>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant payé</label>
                        <div class="input-group mb-3">
                            <input type="number" step="0.01" name="paiement" class="form-control" value="<?= $reservation['paiement'] ?? 0 ?>">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <div>
                        <a href="rooms?hotel_id=<?= $hotelId ?>" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>                  


    <script src="./assets/js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>