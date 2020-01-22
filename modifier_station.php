<!-- A terminer -->

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Insertion d'une station</title>
  <link rel="stylesheet" href="formulaire_station.css">
</head>
<body>
<?php
    /***************************************************
    Nom du script : modifier_station.php
    Description   : Recup du nom de la station à modifier grâce à GET.
                    Ensuite connexion à BDD => recup infos => incluses dans
                    formulaire => envoi.
    Auteur        : M. SALL
    Version       : 1.0
    Date          :  22/01/2020

    ****************************************************/

	/*  ici il faut determiner si on doit afficher ou traiter le formulaire   */
	if(!isset($_POST["Valider"]))
	{
        // Recuperer les données de la station et les inclure dans form
        $editStation = $_GET['nomStation'];

        require_once('connexion.php');
        // envoi de la requête pour recup les données de la station concernée
        $requete="SELECT * FROM station WHERE nomStation like '$editStation'";
        if($bdd = mysqli_connect($serveur, $user, $passwd, $database))
        {
            // recup des données:
            $data = mysqli_fetch_assoc($bdd);
            $name = utf8_encode($donnees['nomstation']);
            $capacity = $donnees['capacite'];
            $location = $donnees['lieu'];
            $region = $donnees['region'];
            $price = $donnees['tarif'];
            ?>
            <div class="">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post"> <!-- PHP ICI !! -->
                    <div class="form1">
                        <label for="zoneCapacite">Capacité</label>
                        <input type="number" name="zoneCapacite" id="" value="<?php echo $capacity; ?>" required>
                    </div>
                    <div class="form1">
                        <label for="zoneLieu">Lieu</label>
                        <input type="text" name="zoneLieu" id="" value="<?php echo $location; ?>" required>
                    </div>
                    <div class="form1">
                        <label for="zoneRegion">Region</label>
                        <select id="zoneRegion" class="" name="zoneRegion" size="1" value="<?php echo $region; ?>">
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
                        <input type="text" name="zoneTarif" id="" value="<?php echo $price; ?>" required>
                    </div>
                </form>
            </div>
            <?php
        }


        }
        else {
            die("Erreur de requete");
        }


    ?>

</body>
</html>
