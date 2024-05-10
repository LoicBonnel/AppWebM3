<?php

$title = "Page De Session Parent";
include('includes/connect-db.php');

include('includes/header.php');


// redirection à la page login si l'utilisateur n'est pas connecté


if(@$_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
}

$_SESSION["autoriser"] = "oui";

// on spécifie les valeurs des variables

$_SESSION["connecte"] = true;

// 'SELECT id_parent FROM compte_parent WHERE login_parent LIKE "%'.$_SESSION["username"].'%"';

$sql = 'CALL CompteP_Select_By_ID(:username_p)';

$statement = $db->prepare($sql);

// liaison des paramètres nommés

$statement->bindParam(":username_p", $_SESSION["username_parent"] );



?>

<!-- page de redirection  -->

<body>
<div id="index">
    <h1>Page confidentielle <a href="deconnexion.php">Déconnexion</a></h1>
    Félicitation vous vous êtes identifié avec succès
    Accéder aux donnés transmis par l'assistante maternelle en cliquant sur ce lien : <a href="liste-informationAM.php">ici</a>
</div>
</body>

<?php
include("includes/footer.php");
?>
