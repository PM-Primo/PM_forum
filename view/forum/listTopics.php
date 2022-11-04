<?php

$topics = $result["data"]['topics'];

?>

<h1>Liste des topics</h1>
<h2>Catégorie : </h2>

<?php
foreach($topics as $topic){

    echo "<p>".$topic->getTitreTopic()."</p>";
    $cat = $topic->getCategorie()->getNomCategorie();
    
}

echo "<p>Catégorie visionnée : $cat"

?>
  
