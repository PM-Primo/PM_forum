<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste des catégories</h1>

<div class="catListe">
    <?php
    foreach($categories as $categorie ){

        ?>
        <p><a href="index.php?ctrl=forum&action=listTopics&id=<?=$categorie->getId()?>"><?=$categorie->getNomCategorie()?></a></p>
        <?php
    }
    ?>
</div>