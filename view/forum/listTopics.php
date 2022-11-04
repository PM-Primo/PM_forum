<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];

?>

<h1>Liste des topics</h1>
<h2>Catégorie : <?= $categorie ?></h2>

<?php
foreach($topics as $topic){

    echo "<p>".$topic->getTitreTopic()."</p>";
    
}

?>
  
