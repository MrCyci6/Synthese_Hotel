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
<div>
    <div class="container border-bottom ">
        <h1 class="text-center py-3 fw-bold">Menu de nos consommations</h1>
    </div>

    <div>
        <h4 class="text-center py-3 fw-bold">Voici la liste de nos consommations :</h4>
    </div>








    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th>Dénomination</th>
                <th>Prix</th>
            </tr>
            </thead>
            <tbody>

            <?php
            for ($i = 0; $i <= $nbConso; $i++) {
                echo "<tr><td>".$consommations[$i]['denomination']."</td><td>".$consommations[$i]['prix']."</td></td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>
<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/img1.jpg" class="d-block w-100" alt="bs">
        </div>
        <div class="carousel-item">
            <img src="images/img2.jpg" class="d-block w-100" alt="pt">
        </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<script src="./js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



