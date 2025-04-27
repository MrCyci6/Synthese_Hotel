        <!-- Content -->
        <div class="p-4 mt-3">
            <div class="container-fluid">
                <!-- Main Content -->
                <div class="row g-4">
                    <!-- Header -->
                    <div class="d-flex align-items-center mb-2">
                        <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked"><path d="M10 2v8l3-3 3 3V2"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                        <h5 class="card-title ms-2 mt-1">Gestion de l'activité</h5>
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
                                                <input type="text" name="search" class="form-control" placeholder="Chercher une activité">
                                                <button type="submit" id="search" class="btn btn-outline-primary">Chercher</button>
                                            </div>
                                        </form>
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
                                    <td class="text-secondary">UTILISATEUR</td>
                                    <td class="text-secondary">ACTION</td>
                                    <td class="text-secondary">DATE</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($logs as $log) {
                                        echo "<tr>
                                            <td>".$log['id_log']."</td>
                                            <td>".$log['nom_user']." ".$log['prenom_user']."</td>
                                            <td>".$log['content']."</td>
                                            <td>".$log['date']."</td>
                                        </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination d-flex">
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=<?= $prevPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Précédent</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=1<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">1</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=2<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">2</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=3<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">3</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=4<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">4</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=5<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">5</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=6<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">6</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=7<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">7</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=8<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">8</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=9<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">9</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">10</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=10<?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">11</a></li>
                                <li class="page-item"><a class="page-link">..</a></li>
                                <li class="page-item"><a class="page-link" href="logs?hotel_id=<?= $hotelId ?>&page=<?= $nextPage ?><?= isset($_GET['search']) ? "&search=".$_GET['search'] : "" ?>">Suivant</a></li>
                            </ul>
                        </nav>  
                    </div>
                </div>
            </div>       
        </div>
    </div>

    <script src="./js/panel-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>