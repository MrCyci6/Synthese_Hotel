<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site hotelier</title>
    <meta name="MathisB" content="">

    <link rel="stylesheet" href="./styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container ">
    <div class="row">
        <div class="col-md-8">
            <h1 class="py-3 fw-bold">Récapitulatif consommations</h1>
        </div>
        <div class="col-6 col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Ajouter Conso Client
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
                                <div class="container">
                                    Dénomination :
                                    <select id="menu" name="menu">
                                        <?php
                                        for ($i = 0; $i < $nbList; $i++){
                                            echo "<option value='".$consommationsArray[$i]["id_conso"]."'>".$consommationsArray[$i]["denomination"]."</option>";
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
                                    for ($i = 0; $i < $nbSejour; $i++){
                                        echo "<option value='".$sejour[$i]['id_sejour']."'>".$sejour[$i]['id_sejour']."</option>";
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
        </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-white table-striped">
                <thead>
                <tr>
                    <th>Client</th>
                    <th>Consommation</th>
                    <th>Nombre</th>
                    <th>Prix unitaire</th>
                    <th>Prix</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Définir le nombre d'éléments par page
                $parPage = 10;
                $totalConso = count($consommations);
                $totalPages = ceil($totalConso / $parPage);

                // Récupérer la page actuelle depuis l'URL
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $page = max(1, min($totalPages, $page)); // Sécurisation

                // Calculer les bornes
                $start = ($page - 1) * $parPage;
                $end = min($start + $parPage, $totalConso);

                for ($i = $start; $i < $end; $i++) {
                    echo "<tr>";
                    echo "<td>".$consommations[$i]['prenom_user']." ".$consommations[$i]['nom_user']."</td>";
                    echo "<td>".$consommations[$i]['conso']."</td>";
                    echo "<td>".$consommations[$i]['nombre']."</td>";
                    echo "<td>".$consommations[$i]['prix_unit']."</td>";
                    echo "<td>".$consommations[$i]['prix']."</td>";
                    echo "<td>".$consommations[$i]['date_conso']."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col text-center">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php
                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?hotel_id=1&page='.($page-1).'">&laquo;</a></li>';
                    }

                    for ($p = 1; $p <= $totalPages; $p++) {
                        $active = ($p == $page) ? 'active' : '';
                        echo '<li class="page-item '.$active.'"><a class="page-link" href="?hotel_id=1&page='.$p.'">'.$p.'</a></li>';
                    }

                    if ($page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="?hotel_id=1&page='.($page+1).'">&raquo;</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="./js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
