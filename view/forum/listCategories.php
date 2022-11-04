<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $categorie ){

    ?>
    <p><?=$categorie->getNomCategorie()?></p>
    <?php
}
