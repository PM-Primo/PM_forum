<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste des catégories</h1>

<div class="catListe">
    <?php
    if(\App\Session::getUser()){
        if(\App\Session::isAdmin()){
            echo "<a href='index.php?ctrl=forum&action=addCategorieForm' class='nvCat'>+ Nouvelle Catégorie</a>";
        }
    }

    foreach($categories as $categorie ){

        ?>
        <p><a href="index.php?ctrl=forum&action=listTopics&id=<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></a></p>
        <?php
    }
    ?>
</div>