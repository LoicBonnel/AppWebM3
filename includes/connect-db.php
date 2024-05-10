<?php

require_once 'config-db.php';

// connexion à la BDD


try{
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpassword);
}catch(PDOException $e){
    die("Erreur de connexion à la base de donnée :".$e->getMessage());
}