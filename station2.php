<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="Monstyle.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th><th>Nom</th><th>PRENOM</th><th>Ville</th><th>Region</th><th>Solde</th><th>Email</th>
        </tr>

	<?php
    /***************************************************
    Nom du script : station.php
    Description   : Script qui se connecte au serveur de base de                       données et à la BD "Agence_voyage" pour interoger                   la table "station" et afficher les résultats dans
                     un tableau HTML
    Auteur        : M. SALL
    Version       : 1.0
    Date          : 13/01/2020

    ****************************************************/

	echo "<h1> Les clients </h1>";
    // CONNEXTION A LA BDD
    // $serveur = 'localhost';
    // $user = 'root';
    // $passwd = '';
    // $database = 'agence';
    require_once('connexion.php');

	// Se connecter au SGBD MySQL et spécifier la BD de travail:
	$bdd = mysqli_connect($serveur, $user, $passwd, $database);
    if ($bdd) {
        echo "Connexion réussie";
        echo "<br>";
        $result = mysqli_query($bdd, 'select * from client');
        if ($result) {
            while($donnees = mysqli_fetch_assoc($result)) {
                // stocker les valeurs des champes dans des variables:
                $id = $donnees['id'];
                $nom = $donnees['nom'];
                $prenom = $donnees['prenom'];
                $ville = $donnees['ville'];
                $region = $donnees['region'];
                $solde = $donnees['solde'];
                $email = $donnees['email'];

                echo "<tr><td>$id</td><td>$nom</td><td>$prenom</td><td>$ville</td><td>$region</td><td>$solde</td><td>$email</td></tr></br>";
            }
            echo "</table>";
            // mysqli_free_result($result);

            /*print_r($result);
            echo "<br>";
            var_dump($result);*/
        }
        else {
            echo "Erreur de requête";
        }
    }
    else {
        die("Probleme");
    }


	?>





</body>
</html>
