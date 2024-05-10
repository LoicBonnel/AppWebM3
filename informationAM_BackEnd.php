<?php

$title = "Modifier action";
require_once 'includes/header.php';
require_once 'includes/connect-db.php';

// préparation de la requête SQL

$sql = ("CALL InfoG_Update(:heure_arrivee,:heure_depart,:nb_repas,:frais_sup,:num)");


$statement = $db->prepare($sql);

// liaison des paramètres nommés


$statement->bindParam(":num", $_POST["numInformation"]);
$statement->bindParam(":heure_arrivee", $_POST["heure_arrivee"]);
$statement->bindParam(":heure_depart", $_POST["heure_depart"]);
$statement->bindParam(":nb_repas", $_POST["nb_repas"]);
$statement->bindParam(":frais_sup", $_POST["frais_sup"]);

//execution de la requête

$executeIsOk = $statement->execute();

//Gestion des messages d'erreurs

if ($executeIsOk){
    $message = "Les informations de l'assistante maternelle ont été mise à jour dans la base de donnée   <a href='index.php'>retourner à l'aceuil su site</a>";

} else {
    $message = "Echec de la mise à jour des informations de l'assistante maternelle dans la base de donnée";
}
?>

<h1>Résultat de la modification :</h1>

<!-- affichage du message  -->

<p><?= $message ?></p>
