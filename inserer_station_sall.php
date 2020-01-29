<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>insertion d'une station</title>
  <link rel="stylesheet" href="Monstyle.css">
</head>
<body>
		<?php
    /***************************************************
    Nom du script : inserrer_station.php
    Description   : Script qui récuperre les données postées par le formulaire
	                "formulaire_station.html" puis se connecte au serveur de base de
				     données et à la BD "Agence_voyage" pour inserrer les données
					dans la bonne table.
    Auteur        : M. SALL
    Version       : 1.0
    Date          :  20/01/2020

    ****************************************************/

	/*!! Attention ne jamais faire confiance aux données envoyées par l'utilisateur */

	// recuperation des données et stockage dans des variables locales
	$station	= utf8_decode($_POST['zoneStation']);
	$capacity	= $_POST['zoneCapacite'];
	$area		= utf8_decode($_POST['zoneLieu']);
	$region		= utf8_decode($_POST['zoneRegion']);
	$price		= $_POST['zoneTarif'];

	// se connecter au SGBD MySQL
	require_once('connexion.php');

	// Se connecter au SGBD MySQL et spécifier la BD de travail
	if ($bdd = mysqli_connect($server, $user, $passwd , $database))
	{
		// on envoie une requete pour inserrer les données
		$requete = "INSERT INTO `station` (`nomstation`, `capacite`, `lieu`, `region`, `tarif`)
		VALUES ('$station', '$capacity', '$area', '$region', '$price')";
		if($result=mysqli_query($bdd, $requete))
		{
			echo "enregistrement effectué";
			// appel du script qui affiche les station
			require_once('station.php');
		}
		else
		{
			// erreur de requête
			die("erreur de requête ");  //affiche le message et stop le script
		}

	}
	else
	{
		// echec connexion
		die("problême de connexion au serveur de base de données");

	}



	?>
</body>
</html>
