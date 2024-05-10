<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?PHP echo $title; ?></title>
    <link rel="stylesheet" href ="style.css">
</head>



    <!-- Bar de navigation  -->

<nav class="navbar">
    <a href="index.php">
        <img src="src/logoFipouille.jpeg" alt="logo Fripouille">
        <h1 class="logo_title">Fripouille</h1>
    </a>

    <ul>
        <?php

        // gestion de l'affichage du login du compte si l'utilisateur est connecté

        session_start();
        if ($_SESSION["connecte"]) { ?>
            <li><a href="liste-informationAM.php">Informations assistante Maternelle</a></li>
            <li><a href="information_compte.php"> <?php echo $_SESSION["username_parent"]; ?> </a></li>
            <?php } else { ?>
            <li><a href="liste-informationAM.php">Informations assistante Maternelle</a></li>
            <li><a href="login.php">Connectez vous</a></li>  <?php
        } ?>
    </ul>
</nav>

    <!-- Gestion du header  -->

<header class="header">
    <div class="header_content">
        <h1 class ="header_0"></h1>
        <p class="cta_catch">L'application intranet qui vous met en relation directe avec votre assistante maternelle</p>
    </div>
    </div>
</header>
</html>

