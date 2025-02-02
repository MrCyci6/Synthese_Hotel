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
            <h1 class="py-3 fw-bold">Récapitulatif consommations</h1>
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
                for ($i = 0; $i <= $nbConso; $i++) {
                    echo "<tr><td>".$consommations[$i]['prenom_user']." ".$consommations[$i]['nom_user']."</td><td>".$consommations[$i]['conso']."</td><td>".$consommations[$i]['nombre']."</td><td>".$consommations[$i]['prix_unit']."</td><td>".$consommations[$i]['prix']."</td><td>".$consommations[$i]['date_conso']."</td></tr>";
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



