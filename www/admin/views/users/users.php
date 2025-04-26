<?php
    if(isset($password) && !empty($password)) {
        echo "<div class=\"d-flex justify-content-end mt-2\">
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                Mot de passe de l'utilisateur créé : $password
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        </div>";
    } else if(isset($error) && !empty($error)) {
        echo "<div class=\"d-flex justify-content-end mt-2\">
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                $error
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        </div>";
    }
?>
        <!-- Content -->
        <div class="p-4 mt-3">
            <div class="container-fluid">
                <div class="row g-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-2">
                            <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <h5 class="card-title ms-2 mt-1">Gestion des utilisateurs</h5>
                        </div>

                        <div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUserModal">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    <span>Nouvel utilisateur</span>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Search -->
                    <div class="card p-3 border-0 shadow">
                        <form method="GET">
                            <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Chercher un utilisateur (cyriac.lenoir@isen-ouest.yncrea.fr)">
                                <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                            </div>
                        </form>
                    </div>
                    <!-- List -->
                    <div class="card p-4 border-0 bt-3 shadow">
                        <!-- Table -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td class="text-secondary">#</td>
                                    <td class="text-secondary">NOM</td>
                                    <td class="text-secondary">E-MAIL</td>
                                    <td class="text-secondary">STATUT</td>
                                    <td class="text-secondary">ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($users as $_user) {
                                        echo "<tr>
                                            <td scope=\"row\">".$_user['id_user']."</td>
                                            <td>".$_user['nom']." ".$_user['prenom']."</td>
                                            <td>".$_user['email']."</td>
                                            <td>".(
                                                $_user['banned'] ? 
                                                "<span class=\"badge rounded-pill bg-danger-subtle text-danger fw-medium\">Banni</span>" : 
                                                "<span class=\"badge rounded-pill bg-success-subtle text-success fw-medium\">Non-Banni</span>"
                                                )."</td>
                                            <td>
                                                <a title=\"Gérer\" href=\"user?hotel_id=".$hotelId."&user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                    <svg class=\"text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-user-round-pen\"><path d=\"M2 21a8 8 0 0 1 10.821-7.487\"/><path d=\"M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z\"/><circle cx=\"10\" cy=\"8\" r=\"5\"/></svg>
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination d-flex">
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Précédent</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=1<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">1</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=2<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">2</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=3<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">3</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=4<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">4</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=5<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">5</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=6<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">6</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=7<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">7</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=8<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">8</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=9<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">9</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">10</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">11</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="users?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Suivant</a></li>
                            </ul>
                        </nav>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create user -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header border-0">
                    <div class="modal-title d-flex align-items-center gap-2">
                        <div class="bg-primary-subtle p-2 rounded-circle d-flex align-items-center">    
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                        </div>
                        <h1 class="fs-5">Créer un utilisateur</h1>
                    </div>
                </div>
                <form action="users">
                    <div class="modal-body border-0">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">

                        <label for="nom" class="form-label">Nom</label> 
                        <input type="text" class="form-control" id="nom" name="nom" value="" required>
                        
                        <label for="prenom" class="form-label">Prénom</label> 
                        <input type="text" class="form-control" id="prenom" name="prenom" value="" required>
                        
                        <label for="email" class="form-label">Adresse E-mail</label> 
                        <input type="text" class="form-control" id="email" name="email" value="" required>
                        
                        <label for="addresse" class="form-label">Adresse Postale</label> 
                        <input type="text" class="form-control" id="addresse" name="adresse" value="" required>

                        <div class="form-text">
                            Une fois le formulaire validé, un mot de passe auto-généré sera envoyé
                            sur l'adresse e-mail de l'utilisateur pour qu'il puisse se connecter
                            à son compte
                        </div>
                    </div>
                    <div class="modal-footer border-0 mt-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer un utilisateur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>