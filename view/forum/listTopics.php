<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];
$catId=$categorie->getId();

?>

<h1>Liste des topics</h1>
<h2>Catégorie : <?= $categorie ?></h2>
<?php if(App\Session::getUser()){ ?>
    <a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$catId?>">Nouveau topic<a>
<?php } ?>

<?php
foreach($topics as $topic){
    echo "<p><a href='index.php?ctrl=forum&action=listPosts&id=".$topic->getId()."'>".$topic->getTitreTopic()."</a>";
    if ($topic->getVerrouTopic()){
        echo " [VERROUILLÉ]";
    } 
    if (\App\Session::getUser()->getId() == $topic->getUser()->getId()){
        echo " [<a href='index.php?ctrl=forum&action=editTopicForm&id=".$topic->getId()."'>Éditer</a> / <a href='index.php?ctrl=forum&action=deleteTopic&id=".$topic->getId()."'>Supprimer</a>]";
    } 
    echo "<br>Date ".$topic->getDateCreaTopic()." - Auteur :  ".$topic->getUser()."</p>";
}

?>
  
