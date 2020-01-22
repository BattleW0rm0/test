<!-- Structure fichier Sall, contenu moi, erreur de fermeture de crochet me faisait
chier sur le premier fusion -->
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
    Nom du script : inserrer_station.php
    Description   : Script qui affiche ou récuperre les données postées par le formulaire,
	                 puis se connecte au serveur de base de
				     données et à la BD "Agence_voyage" pour inserrer les données
					dans la bonne table.
    Auteur        : M. SALL
    Version       : 1.0
    Date          :  22/01/2020

    ****************************************************/

	/*  ici il faut determiner si on doit afficher ou traiter le formulaire   */
	if(!isset($_POST["Valider"]))
	{
		// afficher le formulaire
?>
<div class="">
    <h1>Ajouter une station</h1>
    <hr>
    <form action="inserer_station.php" method="post"> <!-- Ou envoyer -->
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
<?php
	}
	else
	{
        $station = $_POST["zoneStation"]; // nom de l'element à recup (le name!) dans quotes
        $capacity = $_POST["zoneCapacite"];
        $area = $_POST["zoneLieu"];
        $region = $_POST["zoneRegion"];
        $price = $_POST["zoneTarif"];

        echo "$station $capacity $area $region $price";

        require_once('connexion.php');
        if($bdd = mysqli_connect($serveur, $user, $passwd, $database))
        {
            // envoi d'une requete pour insérer données:
            $requete = "INSERT INTO `station`(`nomStation`, `capacite`, `lieu`, `region`, `tarif`) VALUES('$station', '$capacity', '$area', '$region', '$price')";
            echo "Insertion réussie";
            echo $requete;

            if ($result = mysqli_query($bdd, $requete)){
                echo "Données insérées";
            }
            else {
                // erreur de requete
                die("Erreur de requete");
        }
        }
        else {
            // echec connexion
            die("Probleme de connexion au serveur de BDD");
        }
    }




	?>
</body>
</html>
