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
        <p>
            <a href="index.php?ctrl=forum&action=listTopics&id=<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></a>
            <?php 
            if(\App\Session::getUser()){
                if(\App\Session::isAdmin()){
                    echo "&nbsp&nbsp<a href='index.php?ctrl=forum&action=editCategorieForm&id=".$categorie->getId()."'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp
                    <a href='index.php?ctrl=forum&action=deleteCategorie&id=".$categorie->getId()."'><i class='fa-solid fa-trash'></i></a>";
                }
            }
            ?>
        </p>
        <?php
    }
    ?>
</div>