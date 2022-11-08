<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];
$catId=$categorie->getId();

?>

<h1>Liste des topics</h1>
<h2>Catégorie : <?= $categorie ?></h2>

<a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$catId?>">Nouveau topic<a>

<?php
foreach($topics as $topic){
    echo "<p><a href='index.php?ctrl=forum&action=listPosts&id=".$topic->getId()."'>".$topic->getTitreTopic()."</a> - Date ".$topic->getDateCreaTopic()." - Auteur :  ".$topic->getUser()."</p>";
}

?>
  
