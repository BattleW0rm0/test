<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Insertion Client</title>
</head>
<body>
	<?php

// !!!! Methode NON SECURISEE pour recup les données.
// Ne jamais faire confiance aux données utilisateurs.

$id = $_POST["zoneId"];
$lastName = utf8_decode($_POST["zoneNom"]);
$firstName = utf8_decode($_POST["zonePrenom"]);
$city = utf8_decode($_POST["zoneVille"]);
$region = utf8_decode($_POST["zoneRegion"]);
$balance = ($_POST["zoneSolde"]);
$mail = $_POST["zoneEmail"];

echo "$id, $lastName, $firstName, $city, $region, $balance, $mail";

require_once('connexion.php');
if($bdd = mysqli_connect($serveur, $user, $passwd, $database))
{
    // envoi d'une requete pour insérer données:
    $requete = "INSERT INTO `client`(`id`, `nom`, `prenom`, `ville`, `region`, `solde`, `email`) VALUES($id, '$lastName', '$firstName', '$city', '$region','$balance','$mail')";
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
