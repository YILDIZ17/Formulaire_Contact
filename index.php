<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>

    <?php
        if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']); // Supprime une cellule d'un tableau
    }
    ?>

    <h1>Ajouter une catégorie</h1>
    <form action="" method="POST">
        <label for="nom">Nom: </label>
        <input type="text" id="nom" name="nom"><br>
        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <input type="submit" name="envoyer" value="Ajouter">
    </form>
    
    <?php

        require_once 'BDD.php';
        require_once 'CategorieManager.php';

        $categorieManager = new CategorieManager();

        // On regarde si on a reçu le bouton d'envoie du formulaire
        if(isset($_POST['envoyer'])){
            // Si on l'a reçu, c'est que le formulaire a été soumis

            if(empty($_POST['nom']) || empty($_POST['description'])){
                echo "<p>Veuillez renseigner tous les champs du formulaire</p>";
            }
            else{
                // Les champs sont bien renseignés, on sauvegarde en base

                $insert = $categorieManager->add($_POST['nom'], $_POST['description']);

                if($insert > 0){
                    echo '<p> Insertion effectuée </p>';
                }
                else{
                    echo '<p> Une erreur est survenue </p>';
                }
            }
        }
    ?>
        <h2>Liste des categories</h2>
        <?php
            $categories = $categorieManager->categories();

            // Si $categories n'est pas vide
            if(!empty($categories)){
                foreach($categories as $cat){
                    ?>
                    <h3><?= $cat['nom']; ?></h3>
                    <p><?= $cat['description']; ?></p>
                    <p><a href="supprimer.php?id=<?= $cat['id']; ?>">Supprimer</a></p>
                    <p><a href="modifier.php?id=<?= $cat['id'];?>">Modifier</a></p>
                    <hr>
                    <?php
                }
            }
            else{
                // $categories est vide
                echo "<p> Il n'y a aucune catégorie</p>";
            }
        ?>

</body>
</html>


