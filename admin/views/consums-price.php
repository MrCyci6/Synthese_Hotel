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
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>

<!--
    <script>
        let enEdition = false;

        function toggleEdition() {
            let btn = document.getElementById("editBtn");
            let cellules = document.querySelectorAll("td.editable");

            if (!enEdition) {
                // Rendre les cellules éditables
                cellules.forEach((cell, i, t) => {
                    let valeurActuelle = cell.innerText;
                    cell.innerHTML = `<input type='number' step='0.5' id='prix_`+i+`' value='${valeurActuelle}'>`;
                });
                btn.innerText = "Enregistrer";
            } else {
                // Récupérer les valeurs et envoyer via AJAX
                let valeurs = [];
                let lignes = document.querySelectorAll("tr[data-id]");

                lignes.forEach(ligne => {
                    let consommation_id = ligne.getAttribute("data-id");
                    let prix = ligne.querySelector(".prix input").value;
                    valeurs.push({ consommation_id, prix });
                });
                console.log("Valeurs envoyées :", valeurs);

                // Envoyer les nouvelles valeurs au serveur
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "consums-prices.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onreadystatechange = function () {
                    console.log("Réponse du serveur :", xhr.responseText);
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText);
                    }
                    else{
                        alert("Erreur d'enregistrement !");
                    }
                };

                xhr.send(JSON.stringify({ hotel_id: <?= $hotel_id ?>, consommations: valeurs }));

                // Mettre à jour les cellules avec les nouvelles valeurs
                lignes.forEach(ligne => {
                    ligne.querySelector(".prix").innerText = ligne.querySelector(".prix input").value;
                });

                btn.innerText = "Modifier";
            }
            enEdition = !enEdition;
        }
    </script>
-->

</head>
<body>
<div class="container ">
    <div class="row">
        <div class="col-md-8">
            <h1 class="py-3 fw-bold">Menu de nos consommations</h1>
        </div>
        <div class="col-6 col-md-4">
<!--            <button class="btn btn-primary" id="editBtn" onclick="toggleEdition()">Éditer prix</button>   -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Modifier
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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
                    echo "<tr><td id='data-id'>".$consommations[$i]['id_conso']."</td><td>".$consommations[$i]['denomination']."</td><td class='editable prix'>".$consommations[$i]['prix']."</td></td></tr>";
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



