<?php

session_start();
require_once 'BDD.php';
require_once 'CategorieManager.php';

// Si on a reçu l'id a supprimer
if(isset($_GET['id'])){
    $categorieManager = new CategorieManager();
    $categorie = $categorieManager->une_categorie($_GET['id']);

    // Si j'ai reçu une catégorie, je l'affiche dans le formulaire
    if(!empty($categorie)){
    ?>
        <form action="" method="POST">
        <label for="nom">Nom: </label>
        <input type="text" id="nom" name="nom" value="<?= $categorie['nom']; ?>"><br>
        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $categorie['description']; ?></textarea><br>
        <input type="submit" name="envoyer" value="Modifier">
    </form>
    <?php
        // Si le formulaire a été soumis
        if(isset($_POST['envoyer'])){
            if(empty($_POST['nom']) || empty($_POST['description'])){
                echo "<p>Veuillez renseigner tous les champs du formulaire</p>";
            }
            else{
                // Les champs sont bien renseignés, on sauvegarde en base

                $edit = $categorieManager->add($_POST['nom'], $_POST['description'], $_GET['id']);

                if($edit > 0){
                    echo '<p> Insertion effectuée </p>';
                    echo '<p><a href="index.php">Retour</a></p>';
                }
                else{
                    echo '<p> Une erreur est survenue </p>';
                }
            }
        }
    }
    else{
        $_SESSION['message'] = "<p style='color: red;'>Catégorie introuvable</p>";
        header('Location: index.php');
    }
}
else{
    $_SESSION['message'] = "<p style='color: red;'>Catégorie introuvable</p>";
}
