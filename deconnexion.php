<?php
session_start();

// session_destroy(); --> supprime toutes les sections actuelle

session_destroy();

// redirection vers la page login

header("location:login.php");


include("includes/footer.php");
?>
