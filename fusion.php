<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire station Fusion</title>
    <link rel="stylesheet" href="formulaire_station.css">
</head>

<body>
<?php
    if (!isset ($_POST["Valider"])) {
        ?>
        <div class="">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post"> <!-- PHP ICI !! -->
                <div class="form1">
                    <label for="zoneStation" focus>Nom de la station</label>
                    <input type="text" name="zoneStation" id="zoneStation" placeholder="Nom" required>
                </div>
                <div class="form1">
                    <label for="zoneCapacite">Capacité</label>
                    <input type="number" name="zoneCapacite" id="" required>
                </div>
                <div class="form1">
                    <label for="zoneLieu">Lieu</label>
                    <input type="text" name="zoneLieu" id="" required>
                </div>
                <div class="form1">
                    <label for="zoneRegion">Region</label>
                    <select id="zoneRegion" class="" name="zoneRegion" size="1">
                        <option disable>Sélectionner votre région</option>
                        <option value="Ocean Indien">Océan indien</option>
                        <option value="Antilles">Antilles</option>
                        <option value="Europe">Europe</option>
                        <option value="Amérique">Amérique</option>
                        <option value="Extreme-Orient">Extreme-Orient</option>
                    </select>
                </div>
                <div class="form1">
                    <label for="zoneTarif">Tarif</label>
                    <input type="text" name="zoneTarif" id="" required>
                </div>

                <div class="form1">
                    <input type="submit" value="Valider">
                </div>
            </form>
        </div>
    }
<?php

?>

</body>

</html>
