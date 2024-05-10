<?php include("includes/header.php") ?>
<div id="index">

<h2>Vous êtes actuellement connecté à : </h2>

<?php
echo "<h3>". ($_SESSION["username_parent"]). "</h3>";
?>


<!-- page HTML de redirection  -->

<h5>Accéder à vos informations transmises par l'assistante maternelle récemment :</h5>
<a href="liste-informationAM.php">Accéder à vos informations transmises par l'assistante maternelle récemment</a></h3>

    <h3>Page confidentielle <a href="deconnexion.php">Déconnexion</a></h3>

</div>

<?php
include ("includes/footer.php");
?>
