<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <title>Factures</title>
</head>
<body>
    <div id="bill" style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
        <h1 style="text-align:center;">Facture Au-Tel 2 Lux</h1>
        <hr style="margin:20px 0;">

        <h2>Informations Client</h2>
        <p><strong>Nom :</strong> <?= $user['nom'] ?></p>
        <p><strong>Prénom :</strong> <?= $user['prenom'] ?></p>
        <p><strong>Email :</strong> <?= $user['email'] ?></p>
        <p><strong>Adresse :</strong> <?= $user['adresse'] ?></p>

        <h2 style="margin-top:30px;">Détails du Séjour</h2>
        <p><strong>Numéro de Séjour :</strong> <?= $sejourId ?></p>
        <p><strong>Date d'Arrivée :</strong> <?= $sejour['date_debut'] ?></p>
        <p><strong>Date de Départ :</strong> <?= $sejour['date_fin'] ?></p>

        <h2 style="margin-top:30px;">Résumé des Consommations</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;" border="1">
            <thead style="background-color: #f0f0f0;">
                <tr>
                    <th style="padding:8px;">Description</th>
                    <th style="padding:8px;">Quantité</th>
                    <th style="padding:8px;">Prix Unitaire</th>
                    <th style="padding:8px;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalConsos = 0;
                    foreach($consos as $conso) {
                        echo '<tr>
                            <td style="padding:8px;">'.$conso['conso_name'].'</td>
                            <td style="padding:8px;">'.$conso['nombre'].'</td>
                            <td style="padding:8px;">'.$conso['unit_price'].'€</td>
                            <td style="padding:8px;">'.$conso['prix_total'].'€</td>
                        </tr>';
                        $totalConsos += $conso['prix_total'];
                    }
                ?>
            </tbody>
        </table>

        <h2 style="margin-top:30px;">Prix</h2>
        <p><strong>Prix de la chambre :</strong> <?= $roomPrice ?>€</p>
        <p><strong>Total des consommations :</strong> <?= $totalConsos ?>€</p>

        <h2 style="margin-top:20px; text-align:right;">Total à Payer : <span style="color:#000;"> <?= $roomPrice + $totalConsos?>€</span></h2>

        <hr style="margin:30px 0;">
        <p style="text-align:center; font-size:12px;">Merci d'avoir choisi Au-Tel 2 Lux. Nous espérons vous revoir bientôt !</p>
    </div>

    <script src="assets/js/bills.js"></script>
</body>
</html>