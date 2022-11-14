<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];
$catId=$categorie->getId();

?>
<h1>Topics - <?= $categorie ?> : </h1>
<?php if(App\Session::getUser()){ ?>
    <a href="index.php?ctrl=forum&action=addTopicForm&id=<?=$catId?>">Nouveau topic<a>
<?php } ?>

<?php
if($topics){
    foreach($topics as $topic){
        echo "<p class='uniteTopic'><a href='index.php?ctrl=forum&action=listPosts&id=".$topic->getId()."'>".$topic->getTitreTopic()."</a>";
        if ($topic->getVerrouTopic()){
            echo "&nbsp&nbsp<i class='fa-solid fa-lock'></i>";
        } 
        if(\App\Session::getUser()){
            if (\App\Session::getUser()->getId() == $topic->getUser()->getId()){
                echo " [<a href='index.php?ctrl=forum&action=editTopicForm&id=".$topic->getId()."'>Éditer</a> /
                <a href='index.php?ctrl=forum&action=deleteTopic&id=".$topic->getId()."'>Supprimer</a> / ";
                
                if($topic->getVerrouTopic()){
                    echo "<a href='index.php?ctrl=forum&action=unlockTopic&id=".$topic->getId()."'>Déverrouiller</a>";
                }
                else{
                    echo "<a href='index.php?ctrl=forum&action=lockTopic&id=".$topic->getId()."'>Verrouiller</a>";
                }
                echo "]";
            } 
        }   
        echo "<br>Date ".$topic->getDateCreaTopic()." - Auteur :  ".$topic->getUser()." - ".$topic->getNbPostsTopic()." Réponses</p>";
    }
}
else{
    echo "<p>Aucun topic dans cette catégorie</p>";
}

?>
  
