        <!-- Content -->
        <div class="p-4">
            <div class="container row g-4">
                <!-- Header -->
                <div class="d-flex align-items-center mb-2">
                    <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <h5 class="card-title ms-2 mt-1">Gestion des utilisateurs</h5>
                </div>
                <!-- Search -->
                <div class="card p-4 border-0">
                    <form method="GET" action="users.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Chercher un utilisateur (cyriac.lenoir@isen-ouest.yncrea.fr)">
                            <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                        </div>
                    </form>
                    <?php
                        if(isset($userSearch)) {
                            if(!$userSearch) {
                                echo "<span class=\"mt-3 text-danger\">Utilisateur introuvable : $search</span>";
                            } else {
                                foreach($userSearch as $_user) {
                                    echo "<div class=\"row g-4 ms-1 mt-1\">
                                        <div class=\"col-1 p-2 bg-body-secondary fw-bold\">".$_user['id_user']."</div>
                                        <div class=\"col-3 p-2 bg-body-secondary\">".$_user['nom']." ".$_user['prenom']."</div>
                                        <div class=\"col-5 p-2 bg-body-secondary\">".$_user['email']."</div>
                                        <div class=\"col-3 p-2 bg-body-secondary\">
                                            <a title=\"Permissions\" href=\"user/perms.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-success\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"/></svg>
                                            </a>
                                            <a title=\"Modifer\" href=\"user/edit.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-user-round-pen\"><path d=\"M2 21a8 8 0 0 1 10.821-7.487\"/><path d=\"M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z\"/><circle cx=\"10\" cy=\"8\" r=\"5\"/></svg>
                                            </a>
                                            <a  title=\"Bannir\" href=\"user/ban.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-warning\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m4.9 4.9 14.2 14.2\"/></svg>
                                            </a>
                                            <a title=\"Supprimer\" href=\"user/delete.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-danger\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-x\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>
                                            </a>
                                        </div>
                                    </div>";
                                }
                            }
                        }
                    ?>
                </div>
                <!-- List -->
                <div class="card p-4 border-0 bt-3">
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($users as $_user) {
                                    echo "<tr>
                                        <th scope=\"row\">".$_user['id_user']."</th>
                                        <td>".$_user['nom']." ".$_user['prenom']."</td>
                                        <td>".$_user['email']."</td>
                                        <td>
                                            <a title=\"Permissions\" href=\"user/perms.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-success\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"/></svg>
                                            </a>
                                            <a title=\"Modifer\" href=\"user/edit.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-user-round-pen\"><path d=\"M2 21a8 8 0 0 1 10.821-7.487\"/><path d=\"M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z\"/><circle cx=\"10\" cy=\"8\" r=\"5\"/></svg>
                                            </a>
                                            <a  title=\"Bannir\" href=\"user/ban.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-warning\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-ban\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m4.9 4.9 14.2 14.2\"/></svg>
                                            </a>
                                            <a title=\"Supprimer\" href=\"user/delete.php?user_id=".$_user['id_user']."\" class=\"text-decoration-none\">
                                                <svg class=\"text-danger\" xmlns=\"http://www.w3.org/2000/svg\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-x\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg>
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination d-flex">
                            <li class="page-item"><a class="page-link" href="users.php?page=<?= $prevPage ?>">Précédent</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=2">2</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=3">3</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=4">4</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=5">5</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=6">6</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=7">7</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=8">8</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=9">9</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=10">10</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=10">11</a></li>
                            <li class="page-item"><a class="page-link">..</a></li>
                            <li class="page-item"><a class="page-link" href="users.php?page=<?= $nextPage ?>">Suivant</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>