
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Chambre disponible</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

     <h1 class="text-center mb-5"><?=htmlspecialchars($chambres[$id_hotel]['hotel_nom']) ?> </h1>


    <div class="row g-4">
        <?php foreach ($chambres as $chambre):?>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($chambre['categorie_nom'])?></h5>
                        <p class="card-text">
                            <strong>Prix :</strong> <?= htmlspecialchars($chambre['prix']) ?> €<br>
                            <strong>Classe :</strong> <?= htmlspecialchars($chambre['classe']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
