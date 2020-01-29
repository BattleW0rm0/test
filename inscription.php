<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <h1 class="mobile">Inscription</h1>
<?php
    /***************************************************
    Nom du script : inscription.php
    Description   : Script qui affiche un formulaire d'inscription.
                    une fois le formulaire soumis, les données sont vérifiées et les élèments sont ajoués à la BD.
                    le mot de passe sera enregistré sous forme
                    cryptée.
    Version       :  1.0
    Date          : 29/01/2020

    ****************************************************/
    /*  ici il faut determiner si on doit afficher ou traiter le formulaire   */
	if(!isset($_POST["Valider"]))
	{
        // afficher le formulaire
        ?>
        <div class="formulaire">
            <form action ="<?php $_SERVER['PHP_SELF']?>" method ="post">
    			<div class="form1">
    				<!-- zone email  -->
    				<label for="zoneEmail">Email</label>
    				<input type="text" id ="zoneEmail" name="zoneEmail"
    				   placeholder=" Email" required>
    			</div>
    			<div class="form1">
    				<!-- zone password -->
    				<label for="zonePassword">Mot de passe</label>
    				<input type="password" id ="zonePassword" name="zonePassword"
    				   placeholder=" Mot de passe" required>
    			</div>
    			<div class="form1">
    				<!-- zone confirm password -->
    				<label for="zoneConfirmPassword">Confirmation </label>
    				<input type="password" id ="zoneConfirmPassword" name="zoneConfirmPassword"
    				   placeholder=" Confirmez" required>
    			</div>

    			<div>
    				<button class="button" type="submit" name ="Valider"> Valider </button>

    			</div>
    		</form>
        </div>

    <?php
    }
    else
    {
        // traitement du formulaire

        // 1. récuperrer les données postées
        $user_mail     = $_POST['zoneEmail'];
        $user_password = $_POST['zonePassword'];
        $user_confirm  = $_POST['zoneConfirmPassword'];

        //2. filtrer, netoyer les données
        $user_mail = sanitizeString($user_mail);
        $user_password = sanitizeString($user_password);
        $user_confirm = sanitizeString( $user_confirm);
        var_dump($user_confirm);
        echo strlen($user_confirm);

        //3. verifier les données et la longueur du mot de pass
    if ( strlen($user_confirm) > 5) {
        if ($user_password==$user_confirm)
        {
            // mot de passe et confirmation sont identiques
            echo " les mots de passe sont identiques <br>";
            $mdp_hash = password_hash($user_password, PASSWORD_DEFAULT);
            echo "Mdp chiffré: $mdp_hash";

            // BDD
            require_once('connexion.php');

            if ($bdd = mysqli_connect($serveur, $user, $passwd , $database))
        	{
                // Protection contre injections MySQL
                $user_mail = mysqli_escape_string($bdd, $user_mail);
                $mdp_hash = mysqli_escape_string($bdd, $mdp_hash);
        		// on envoie une requete pour inserer les données
        		$requete = "INSERT INTO `utilisateurs` (`email`, `passwd`)
        		VALUES ('$user_mail', '$mdp_hash')";
        		if($result=mysqli_query($bdd, $requete))
        		{
        			echo "Données insérées";
        		}
        		else
        		{
        			// erreur de requête
        			die("erreur de requête ");  //affiche le message et stop le script
        		}
        	}

        }
        else
        {
            echo " les mots de passe ne sont pas identiques";
        }

    }
    else {
        die('Mot de passe trop court');
    }

    }


    function sanitizeString($var)
	{
		// on teste si l'option "magic_quote est active
		if(get_magic_quotes_gpc())
		{
			// on supprime les éventuels antislashs de la chaine $var
			$var = stripslashes($var);
		}
		// Supprime les balises HTML et PHP de la chaine $var
		$var =strip_tags($var);

		//Convertit tous les caractères spéciaux en entités HTML
		$var = htmlentities($var);

		// on retourne la chaine filtrée
		return $var;
	}

    function passCheck($pax) {
        $special = ['*','$','!','?','-','_'];
        $nums = ['1','2','3','4','5','6','7','8','9'];
        $paxArray = str_split($pax);

        foreach ($paxArray as $char) {
            echo $char;
        }
    }

    ?>

    <br>
    <br>
    </body>
</html
