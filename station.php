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
            <th>Nom de la station</th> <th>Capacité</th> <th>Lieu</th> <th>Région</th> <th>Tarif</th>
        </tr>

	<?php
    /***************************************************
    Nom du script : station.php
    Description   : Script qui se connecte au serveur de base de données et à la BD "Agence_voyage" pour interoger la table "station" et afficher les résultats dans un tableau HTML
    Auteur        : M. SALL
    Version       : 1.0
    Date          : 13/01/2020

    ****************************************************/
    session_start(); // Activation de la session
    if (!isset($_SESSION)) {
        echo "Vous n'etes pas connectés <br>";
        echo '<a href="connect.php">Connexion</a>';
    }
    else {

	echo "<h1> Les stations </h1>";
    // CONNEXION A LA BDD
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
        $result = mysqli_query($bdd, 'select * from station');
        if ($result) {
            while($donnees = mysqli_fetch_assoc($result)) {
                // stocker les valeurs des champes dans des variables:
                $name = utf8_encode($donnees['nomstation']);
                $capacity = $donnees['capacite'];
                $location = $donnees['lieu'];
                $region = $donnees['region'];
                $price = $donnees['tarif'];

                // echo "$name $capacity $location $region $price";
                echo "<tr><td>$name</td><td>$capacity</td><td>$location</td><td>$region</td><td>$price</td><td><a href='modifier_station.php?nomStation=$name'>Modifier</a></td></tr>";
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

}
	?>

</body>
</html>
