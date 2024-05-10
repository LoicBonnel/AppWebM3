<?php

// spécification du titre de la page

$title = "Acceuil Site Fripouille";
include ("includes/header.php");
?>

<div id="index">

    <h1>Bienvenue sur le site Fripouille !</h1>

            <h3>A quoi sert l'application :</h3>

            <p>Grâce à cette application intranet vous pourrez valider les informations transmises par votre assistante maternelle</p>

            <p>Pour cela il vous suffit de vous connecter à votre compte parent en vous rendant sur la page de connexion :</p>


            <ul>
                <?php
                if(@$_SESSION["autoriser"]!="oui"){
                ?>
                <li><a href="login.php">s'identifier à la page De Connexion Parent</a></li>
                <?php } ?>
                <li><a href="liste-informationAM.php">valider les informations transmisse par l'assistante maternelle</a></li>


                <div class="donwload_readme">
                    <h3>Tu ne sais pas comment utiliser l'application ? Tu as des questionnements ?</h3>
                    <p>Si tu as des questionnements sur l'utilisation de cette application, je t'invite à télécharger le document readme.md en cliquant sur le lien juste en dessous </p>
                    <a href="src/README.md" download ="Comment_Utiliser_L'application.md">Télécharger le fichier README qui résume l'application</a>
                </div>
            </ul>
</div>

<?php
include ("includes/footer.php");

