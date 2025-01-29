<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" >
    <title>Site hotelier</title>
    <meta name="MathisB" content="">

    <link rel="stylesheet" href="./styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<h1>Menu de nos consommations</h1>
<hr>
<p>Voici la liste de nos consommations :</p>
<table>
    <thead>
    <tr>
        <th>Dénomination</th>
        <th>Prix</th>
    </tr>
    </thead>
    <tbody>

    <?php
    for ($i = 1; $i <= $nbConso; $i++) {
        echo "<tr><td>".$consommations[$i]['conso']."</td><td>".$consommations[$i]['prix']."</td></td></tr>";
    }
    ?>

    </tbody>
</table>

</body>
</html>



