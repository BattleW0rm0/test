<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="connect.css">
</head>
<body>
<?php
    if(!isset($_POST["Valider"]))
    {
        // afficher le formulaire
        ?>
        <div class="formulaire">
            <form action ="<?php $_SERVER['PHP_SELF']?>" method ="post">
                <div class="form1">

                    <label for="zoneEmail">Votre Email</label>
                    <input type="text" id ="zoneEmail" name="zoneEmail"
                       placeholder=" Email" required>
                </div>
                <div class="form1">

                    <label for="zonePassword">Votre pass</label>
                    <input type="password" id ="zonePassword" name="zonePassword"
                       placeholder=" Mot de passe" required>
                </div>

                <div>
                    <a href="inscription.php"></a>
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
    // 1. récuperrer les données postées
    $user_mail     = $_POST['zoneEmail'];
    $user_password = $_POST['zonePassword'];

    $user_mail = sanitizeString($user_mail);
    $user_password = sanitizeString($user_password);

    require_once('connexion.php');
    if ($bdd = mysqli_connect($serveur, $user, $passwd , $database))
    {
        // Protection contre injections MySQL
        $user_mail = mysqli_real_escape_string($bdd, $user_mail);
        $requete = "SELECT * FROM utilisateurs WHERE email='$user_mail'";

        // Envoi requete
        if($result=mysqli_query($bdd, $requete))
        {
            $nbLignes = mysqli_num_rows($result);
            if ($nbLignes==1) {
                // extraction des données de l'enregistrement
                $row = mysqli_fetch_assoc($result);
                // Recup du mot de passe chiffré dans la bdd
                $mdp_bdd = $row['passwd'];
                // Comparaison pass bdd et pass fourni
                if(password_verify($user_password, $mdp_bdd)){
                    session_start();
                    // enregistrement du mail dans une variable de session
                    $_SESSION['emailUser'] = $user_mail;
                    echo "Vous êtes connecté <br>";
                    echo '<a href="station.php">Liste des stations</a>';

                }
            }
            else {
                echo "Mail deja pris";
            }
        }
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
?>
</body>
</html
