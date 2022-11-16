<?php
$topics = $result["data"]['topics'];
$user = $result["data"]['user'];
?>

<a href="index.php?ctrl=security&action=viewProfile&id=<?= $user->getId() ?>" class='lien'><i class="fa-solid fa-arrow-left"></i> Profil de <?= $user?></a>
<h1>Topics créés par <?=$user?></h1>



<?php
if($topics){
    foreach($topics as $topic){
        echo "<div class='uniteTopic'><a href='index.php?ctrl=forum&action=listPosts&id=".$topic->getId()."' class='lien'>".$topic->getTitreTopic()."</a>";
        if ($topic->getVerrouTopic()){
            echo "&nbsp&nbsp<i class='fa-solid fa-lock'></i>";
        }
        echo "<br><div class='detailsTopic'>".$topic->getDateCreaTopic()." - 
        <a href='index.php?ctrl=forum&action=listTopics&id=".$topic->getCategorie()->getId()."' class='lien'>".$topic->getCategorie()."</a> -
         ".$topic->getNbPostsTopic()." <i class='fa-solid fa-message'></i></div></div>";
    }
}
else{
    echo "Aucun topic à afficher !" ;
}
?>