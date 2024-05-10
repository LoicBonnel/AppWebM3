<?php

$title = "Liste action";
require_once 'includes/header.php';
require_once 'includes/connect-db.php';

if(@$_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
}

// gestion de l'affichage des différents ligne de la table si aucune information n'est saisie dans le input

if(isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
}
?>

<!-- barre de recherche qui permet de filtrer les lignes affichées -->

<body>
    <form  class="search-bar-lister" method="GET">
        <h3>Veuillez saisir la date de la prestation de garde à la-quel vous souhaitez accéder dans la barre de recherche :</h3>
        <input type="date" name="s" placeholder="Veuillez saisir l'id de votre assistante maternelle ">
        <input type="submit" value="rechercher">
    </form>
<?php


// gestion de l'affichage des différents ligne de la table si aucune information n'est saisie dans le input

if(!empty($_GET["s"]) > 0){

      $sql = 'CALL InfoG_Select_All_By_Recherche(:id_parent, :date_prestation)';


    // préparation de la requête

    $statement = $db->prepare($sql);

    //execution de la requête

    $statement->bindParam(':id_parent',$_SESSION['id_parent'], PDO::PARAM_INT);
    $statement->bindParam(':date_prestation',$recherche, PDO::PARAM_STR);
    $statement->closeCursor();

}else {

   // $sql = 'SELECT * FROM information_garde WHERE id_parent='.$_SESSION["id_parent"].' ORDER BY id_assistante DESC';
   $sql = 'CALL infoG_Select_All_ID_parent(:id_parent)';
    $statement = $db->prepare($sql);
    $statement->bindParam(':id_parent',$_SESSION['id_parent'] , PDO::PARAM_STR);
    $statement->closeCursor();


}

$executeIsOk = $statement->execute();

// récupération des résultats


$actions = $statement->fetchAll();



?>

<ul>
    <div class="liste-db-content">
        <h4>Les données correspondent à ce qui se situe dans la base de donnée :</h4>


        <!-- Affichage des lignes de la BDD  -->

        <?php foreach ($actions as $action): ?>
            <div>
                <h2>Date de la prestation : <?= $action['date_info_garde']?> </h2>
                <li>
                    <h3>Heure d'arrivée de l'assistante maternelle : <?= $action['heure_arrivee'] ?> </h3>
                    <h3>Heure de départ de l'assistante maternelle :  <?= $action['heure_depart'] ?> </h3>
                    <h3>Nombres de repas : <?= $action['nb_repas'] ?> </h3>
                    <h3>Frais supplémentaires : <?= $action['frais_sup'] ?> </h3>
                    
                    <a href="informationAM_FrontEnd.php?numInformation=<?= $action['id_information_garde']?>">modifier les informations de garde dans la base de donnée</a>
                </li>
            </div>
        <?php endforeach;  ?>
    </div>
</ul>

<?php
require_once 'includes/footer.php'; ?>
