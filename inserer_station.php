<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Insertion Station</title>
</head>
<body>
	<?php
    /***************************************************
    Nom du script : inserer_station.php
    Description   : Script qui recup les données postées par le form "formulaire_station.html",
                    puis se connecte au serveur de BDD pour insérer données dans
                    la bonne table.
    Auteur        : M. SALL
    Version       : 1.0
    Date          : 20/01/2020

    ****************************************************/

// !!!! Methode NON SECURISEE pour recup les données.
// Ne jamais faire confiance aux données utilisateurs.

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

?>

</body>
</html>
