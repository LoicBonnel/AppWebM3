<?php
include ('../includes/connect-db.php');

session_start();


// Création des variables utile à la connexion


@$cookieAccepte = $_SESSION["cookieAccepte"];


@$login = $_POST["login_parent"];
$_SESSION["username_parent"] = @$login;

@$pass = $_POST["mdp_parent"];
@$valider = $_POST["valider"];
$erreur="";
$information="";
@$validerCookies = $_POST["validerCookies"];
@$validerCookies2 = $_POST["validerCookies2"];



// requête SQL qui sélectionne le password du login dans la BDD

$stmt= $db->prepare('CALL CompteP_Select_MDP(?)');
$stmt->execute(array($login));

FALSE === ($true_mdp = $stmt->fetchColumn());
$stmt->closeCursor();


// Gestion des cookies de sessions (pour éviter la reconnexion de l'utilisateur) :

    if(isset($valider)) {
        if (!empty ($validerCookies) AND !empty ($validerCookies2)) {
            setcookie('login_parent', $_POST["login_parent"], time() + (30 * 24 * 3600));
            setcookie('mdp_parent', $_POST["mdp_parent"], time() + (30 * 24 * 3600));
            // var_dump($_COOKIE);
            $cookieAccepte = "oui";
            $information= ("Vous avez bel et bien accepté les cookies"); }



// Vérification du mot de passe saisie et de celui de la base de données

    if (sha1($pass) == ($true_mdp)) {
        $sql = 'CALL CompteP_Select_By_ID(:username_p)';
        $statement = $db->prepare($sql);
        $statement->bindParam(':username_p',$_SESSION["username_parent"], PDO::PARAM_STR);
        $_SESSION['id_parent'] =  $statement->execute();

        $_SESSION["autoriser"] = "oui";
        header("location:session.php");

    } else {
        $erreur = "Mauvais login ou mot de passe";
    }
}


// Ajout d'un titre à la page

$passCSS ="../style.css";
$title = "Page de connexion parents";
include ('../includes/header.php');
?>


<!-- Création du formulaire de connexion pour les parents -->

<body id="body-connexion">
                <h1>Voici le formulaire pour vous connecter avec votre compte parent :</h1>
        <form name = "fo" method="post" action="">



            <!--  Demande du consentement de l'utilisateur pour récupérer des cookies de sessions -->


            <fieldset class="autoriser-Cookies">
                <legend>autorisez-vous que le site utilise des cookies de session ?</legend>

                <h4>Les cookie de session représente un fichier qui sera glissé sur votre ordinateur et qui aura pour rôle de récupérer votre
                    nom d'utilisateur et votre mot de passe pour vous permettre de revenir sur notre site sans vous connecter à chaque fois.</h4>
                <h5>Évidement votre choix n'est pas réversible, si vous souhaitez changer d'avis rendez-vous sur l'en-tête du site et
                    cliquez sur gestion des cookies, dessus vous pourrez les supprimer et vous en débarrasser à tous jamais.</h5>
                <h5>Sachez que les cookies reste un mois avant d'être supprimé</h5>


    <!-- 2 cases différentes à cocher pour respecter le RGPD  -->

                <div>
                    <input type="checkbox" id="validerCookies" name="validerCookies">
                    <label for="validerCookies">J'ai lue et j'accepte les conditions d'utilisations des cookies</label>
                </div>

                <div>
                    <input type="checkbox" id="validerCookies2" name="validerCookies2">
                    <label for="validerCookies2">Je confirme donnez mon consentement au site web qui pourra mettre en place des cookies de session</label>
                </div>
            </fieldset>




    <!-- input information compte parent  -->

            <div id ="formulaireConnexionP" >
            <h5>Veuillez saisir votre nom d'utilisateur :</h5>
                <div>
                    <input type="text" name="login_parent" value = "<?php echo $login ?>" placeholder="saisissez votre nom d'utilisateur" required/>
                </div>

                <h5>Veuillez saisir votre mot de passe :</h5>
                <div>
                    <input type="password" name="mdp_parent" placeholder="saisissez votre mot de passe" />
                </div>
                <div>
                    <input type="submit" name="valider" value="S'authentifier">
                </div>
            </form>





                <!-- Gestion des erreurs en cas de problèmes de connexion -->

                <?php if (!empty($erreur)) {?>
              <div id="erreur">
                  <?php echo($erreur); ?>
                  <br> <br>
                  <?php
                   echo($information); ?>
              </div>
            <?php } ?>
    </div>
</body>
</html>

<?php
include ("../includes/footer.php");
?>
