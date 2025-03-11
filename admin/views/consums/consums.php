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
                        echo "<tr><td>".$consommations[$i]['prenom_user']." ".$consommations[$i]['nom_user']."</td><td>".$consommations[$i]['conso']."</td><td>".$consommations[$i]['nombre']."</td><td>".$consommations[$i]['prix_unit']."</td><td>".$consommations[$i]['prix']."</td><td>".$consommations[$i]['date_conso']."</td><td></td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="./js/panel-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>