<?php

$title = "Information Application Fripouille";
include ("includes/header.php");
include ("includes/connect-db.php");

if(@$_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
}

// préparation de la requête

$sql = ('CALL InfoG_Select_ALL_By_ID(:num)');


$statement = $db->prepare($sql);

//liaison du paramètre nommé

$statement->bindParam(':num',$_GET['numInformation'], PDO::PARAM_INT);

//execution de la requête

$executeIsOk = $statement->execute();

// récupération des résultats

$informationAM = $statement->fetch();


?>

    <!-- Formulaire qui récupère les données saisit dans la BDD -->

<body>
    <main>
        <div id ="informationAM_top" >
            <h1>Voici les informations que votre assistante maternelle vous à transmise récemment :</h1>
        </div>
        <form method="post" id ='informationAM' action="informationAM_BackEnd.php">


    <!-- Input de type hidden pour récupérer l'id de la ligne à modifier dans la base -->

            <input type="hidden" name="numInformation" value="<?= $informationAM['id_information_garde']?>"/>

            <div>
            <h5>Veuillez saisir l'heure d'arrivée :</h5>
                <input type="text" class="form-control" name="heure_arrivee"  value = "<?= $informationAM['heure_arrivee']; ?>"  placeholder="saisissez un nom" required/>
            </div>

            <div>
            <h5>Veuillez saisir l'heure de départ :</h5>
                <input type="text" class="form-control" name="heure_depart" value = "<?= $informationAM['heure_depart']; ?>" placeholder="saisissez l'heure de départ" required/>
            </div>

            <div>
            <h5>Veuillez saisir le nombre de repas :</h5>
                <input type="text" class="form-control" name="nb_repas" value = "<?= $informationAM['nb_repas']; ?>" placeholder="saisissez le nombre de rapas" />
            </div>

            <div>
            <h5>Veuillez saisir les frais supplémentaires :</h5>
                <input type="number" class="form-control" name="frais_sup" value = "<?= $informationAM['frais_sup']; ?>" placeholder="saisissez les frais supplémentaires" />
            </div>
            <div>
                <input type="submit" value="Valider les modifications" id="valider">
            </div>
        </form>
    </main>
</body>

<?php

require_once 'includes/footer.php';
