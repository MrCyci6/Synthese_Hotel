<?php
    if(!empty($action)) {
        echo "<div class=\"d-flex justify-content-end mt-2\">
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                Mise à jour effectuée avec succès
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        </div>";
    }
?>
        <!-- Content -->
        <div class="p-4 mt-3">
            <div class="container">
                <!-- Header -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="d-flex align-items-center gap-4">
                        <div class="bg-primary-subtle p-3 rounded-circle">
                            <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-8 w-8 text-blue-600"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold"><?= $target['nom']." ".$target['prenom'] ?></h4>
                            <span class="text-secondary"><?= $target['email'] ?></span>
                        </div>
                    </div>
                    <div>
                        <h5><?= $hotels[$hotelId]['name'] ?></h5>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <?php
                        
                            if($target['banned']) {
                                echo "<button type=\"button\" class=\"btn btn-outline-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#unbanModal\">
                                    <div class=\"d-flex align-items-center gap-2\">    
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban h-5 w-5\"><circle cx=\"12\" cy=\"12\" r=\"10\"></circle><path d=\"m4.9 4.9 14.2 14.2\"></path></svg>                                
                                        <span>Débannir</span>
                                    </div>
                                </button>";
                            } else {
                                echo "<button type=\"button\" class=\"btn btn-outline-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#banModal\">
                                    <div class=\"d-flex align-items-center gap-2\">    
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban h-5 w-5\"><circle cx=\"12\" cy=\"12\" r=\"10\"></circle><path d=\"m4.9 4.9 14.2 14.2\"></path></svg>                                
                                        <span>Bannir</span>
                                    </div>
                                </button>";
                            }

                        ?>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <div class="d-flex align-items-center gap-2">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-5 w-5"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                                <span>Supprimer</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- User -->
                <div class="row g-4 mt-2">  
                    <!-- Data -->
                    <div class="col-12 col-lg-6">
                        <div class="card p-4 border-0 rounded shadow">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5>Données de l'utilisateur</h5>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#editModal">
                                        <div class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/></svg>
                                            <span>Modifier</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-between gap-3 ms-2">
                                <div class="d-flex align-items-center jusitfy-content-between gap-2">
                                    <div>
                                        <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-8 w-8 text-blue-600"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    </div>
                                    <div>
                                        <span class="text-secondary">Nom complet</span>
                                        <h5 class="mb-0 fs-6"><?= $target['nom']." ".$target['prenom'] ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center jusitfy-content-between gap-2">
                                    <div>
                                        <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    </div>
                                    <div>
                                        <span class="text-secondary">Adresse E-mail</span>
                                        <h5 class="mb-0 fs-6"><?= $target['email'] ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center jusitfy-content-between gap-2">
                                    <div>
                                        <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <div>
                                        <span class="text-secondary">Adresse postale</span>
                                        <h5 class="mb-0 fs-6"><?= $target['addresse'] ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center jusitfy-content-between gap-2">
                                    <div>
                                        <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-ban"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m4.243 5.21 14.39 12.472"/></svg>
                                    </div>
                                    <div>
                                        <span class="text-secondary">Status</span>
                                        <h5 class="mb-0 fs-6"><?= $target['banned'] ? "banni" : "non-banni" ?></h5>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div> 

                    <!-- Permissions -->
                    <div class="col-12 col-lg-6">
                        <div class="card p-3 border-0 rounded shadow">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5>Permissions de l'utilisateur</h5>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#permModal">
                                        <div class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
                                            <span>Modifier</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-between gap-3 ms-2 mt-2">
                                <div class="d-flex align-items-center jusitfy-content-between gap-2">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                foreach($perms as $perm) {
                                                    echo "<tr>
                                                        <th>".$perm['id_perm']."</th>
                                                        <th>".$perm['perm']."</th>
                                                        <th class=\"d-flex align-items-center\">
                                                            <span>";

                                                    echo $perm['has'] ? 
                                                        "<svg class=\"text-success\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-check\"><path d=\"M20 6 9 17l-5-5\"/></svg>"
                                                        :
                                                        "<svg class=\"text-danger\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-x\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>";

                                                    echo "</span>
                                                        </th>
                                                    </tr>";
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
    </div>

    <!-- Ban modal -->
    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header border-0">
                    <div class="modal-title d-flex align-items-center gap-2">
                        <div class="bg-warning-subtle p-2 rounded-circle d-flex align-items-center">    
                            <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban h-5 w-5"><circle cx="12" cy="12" r="10"></circle><path d="m4.9 4.9 14.2 14.2"></path></svg>                                
                        </div>
                        <h1 class="fs-5">Bannir l'utilisateur</h1>
                    </div>
                </div>
                <div class="modal-body border-0">
                    <span>Êtes-vous sûr de vouloir bannir cet utilisateur ?</span><br>
                    <span>Il ne pourra plus accéder à ce site.</span>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="user.php?action=ban&hotel_id=<?= $hotelId ?>&user_id=<?= $targetId?>" class="btn btn-warning text-light">Bannir l'utilisateur</a>
                </div>
            </div>
        </div>
    </div>

<!-- Unban modal -->
<div class="modal fade" id="unbanModal" tabindex="-1" aria-labelledby="unbanModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <div class="modal-title d-flex align-items-center gap-2">
                    <div class="bg-warning-subtle p-2 rounded-circle d-flex align-items-center">    
                        <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban h-5 w-5"><circle cx="12" cy="12" r="10"></circle><path d="m4.9 4.9 14.2 14.2"></path></svg>                                
                    </div>
                    <h1 class="fs-5">Débannir l'utilisateur</h1>
                </div>
            </div>
            <div class="modal-body border-0">
                <span>Êtes-vous sûr de vouloir débannir cet utilisateur ?</span><br>
                <span>Il pourra de nouveau accéder à ce site.</span>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="user.php?action=unban&hotel_id=<?= $hotelId ?>&user_id=<?= $targetId?>" class="btn btn-warning text-light">Débannir l'utilisateur</a>
            </div>
        </div>
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
                        <h1 class="fs-5">Supprimer l'utilisateur</h1>
                    </div>
                </div>
                <div class="modal-body border-0">
                    <span>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</span><br>
                    <span>Cette action est irréversible.</span>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="users.php?action=delete&hotel_id=<?= $hotelId ?>&user_id=<?= $targetId?>" class="btn btn-danger">Supprimer l'utilisateur</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header border-0">
                    <div class="modal-title d-flex align-items-center gap-2">
                        <div class="bg-success-subtle p-2 rounded-circle d-flex align-items-center">    
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-pen"><path d="M11.5 15H7a4 4 0 0 0-4 4v2"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="7" r="4"/></svg>
                        </div>
                        <h1 class="fs-5">Modifier les informations de l'utilisateur</h1>
                    </div>
                </div>
                <form action="user.php">
                    <div class="modal-body border-0">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                        <input type="hidden" name="user_id" value="<?= $targetId ?>">

                        <label for="nom" class="form-label">Nom</label> 
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $target['nom'] ?>" required>
                        
                        <label for="prenom" class="form-label">Prénom</label> 
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $target['prenom'] ?>" required>
                        
                        <label for="email" class="form-label">Adresse E-mail</label> 
                        <input type="text" class="form-control" id="email" name="email" value="<?= $target['email'] ?>" required>
                        
                        <label for="addresse" class="form-label">Adresse Postale</label> 
                        <input type="text" class="form-control" id="addresse" name="addresse" value="<?= $target['addresse'] ?>" required>

                        <label for="password" class="form-label">Mot de passe</label> 
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="form-text">
                            Une fois le formulaire validé, le mot de passe de l'utilisateur sera remplacé par celui que vous avez défini.
                            Laissez vide pour ne pas le modifier
                        </div>
                    </div>
                    <div class="modal-footer border-0 mt-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Perm modal -->
    <div class="modal fade" id="permModal" tabindex="-1" aria-labelledby="permModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header border-0">
                    <div class="modal-title d-flex align-items-center gap-2">
                        <div class="bg-success-subtle p-2 rounded-circle d-flex align-items-center">    
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-question"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M9.1 9a3 3 0 0 1 5.82 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                        </div>
                        <h1 class="fs-5">Modifier les permissions de l'utilisateur</h1>
                    </div>
                </div>
                <form action="user.php">
                    <input type="hidden" name="action" value="perms">
                    <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                    <input type="hidden" name="user_id" value="<?= $targetId ?>">

                    <div class="modal-body border-0 d-flex flex-row gap-4 flex-wrap">
                        <?php
                        
                            foreach($perms as $perm) {
                                echo "<div class=\"form-check\">
                                    <input type=\"checkbox\" name=\"perms[]\" class=\"form-check-input\" value=\"".$perm['id_perm']."\" id=\"".$perm['perm']."\" ".($perm['has'] ? "checked" : "").">
                                    <label for=\"".$perm['perm']."\" class=\"form-label\">".$perm['perm']."</label>
                                </div>";
                            }

                        ?>
                        <div class="form-text">
                            Si vous enlevez toutes les permissions d'un utilisateur, il sera considérer comme client.
                        </div>
                    </div>
                    <div class="modal-footer border-0 mt-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>