<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="./assets/styles/auth.css">
    
    <title>Connexion</title>
</head>
<body>
    <div class="form-container">
        <form method="POST">
            <p>Connexion</p>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-check mb-3 text-start">
                <input type="checkbox" class="form-check-input" name="staylogged" id="stay">
                <label for="stay" class="form-check-label">Rester connecté</label>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning">Connexion</button>
                <a href="register" class="btn btn-outline-light">Inscription</a>
            </div>
        </form>
    </div>
</body>
</html>