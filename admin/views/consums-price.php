<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" >
    <title>Site hotelier</title>
    <meta name="MathisB" content="">

    <link rel="stylesheet" href="./styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container ">
    <div class="row">
        <div class="col-md-8">
            <h1 class="py-3 fw-bold">Menu de nos consommations</h1>
        </div>
        <div class="col-6 col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Ajouter Consommation
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
                                Dénomination : <input type="text" name="new_conso"><br><br>
                                Prix : <input type="number" step="0.5" name="new_price">
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
        <div class="table-responsive">
            <table class="table table-white table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Dénomination</th>
                    <th>Prix</th>
                </tr>
                </thead>
                <tbody>

                <?php
                for ($i = 0; $i < $nbConso; $i++) {
                    echo "<tr><td>".$consommations[$i]['id_conso']."</td><td>".$consommations[$i]['denomination']."</td><td>".$consommations[$i]['prix']."</td></td></tr>";
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="./js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



