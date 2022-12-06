<?php

session_start();

// Si on a reçu un identifiant à supprimer
if(isset($_GET['id'])){
    require_once 'BDD.php';
    require_once 'CategorieManager.php';

    $categorieManager = new CategorieManager();
    $suppression = $categorieManager->supprimer($_GET['id']);

    if($suppression == 0){
        $_SESSION['message'] = "<p style='color: red;'> Une erreur est survenue lors de la suppression</p>";
    }
    else{
        $_SESSION['message'] = "<p style='color: green;'> Suppression effectuée</p>";
    }
}

    // On redirige l'internaute vers index.php
    header('Location: index.php');
