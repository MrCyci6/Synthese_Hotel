<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chambre disponible</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <!-- Nom de l'hotel -->
    <h1 class="text-center mb-5 display-5 text fw-bold">
        <?= htmlspecialchars($chambres[$id_hotel]['hotel_nom']) ?>
    </h1>

    <!-- Liste des chambres -->
    <div class="row g-4">
        <?php foreach ($chambres as $chambre): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="card-title text-success"><?= htmlspecialchars($chambre['categorie_nom']) ?></h5>
                        <p class="card-text">
                            <span class="badge bg-info text-dark mb-2">
                                Prix : <?= htmlspecialchars($chambre['prix']) ?> €
                            </span><br>
                            <span class="badge bg-secondary">
                                Classe : <?= htmlspecialchars($chambre['classe']) ?>
                            </span>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <button class="btn btn-outline-primary btn-sm">Réserver</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
