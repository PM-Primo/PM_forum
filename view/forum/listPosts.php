<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
$firstPost = $result["data"]['firstPost'];
$topicId = $topic->getId();
$catId = $topic->getCategorie()->getId();
$catNom = $topic->getCategorie()->getNomCategorie();
$verrouTopic = $topic->getVerrouTopic();

?>

<a href="index.php?ctrl=forum&action=listTopics&id=<?= $catId ?>"><i class="fa-solid fa-arrow-left"></i> <?= $catNom?></a>
<h1><?php echo $topic; if($verrouTopic){echo "&nbsp&nbsp<i class='fa-solid fa-lock'></i>";} ?></h1>


<?php
if(\App\Session::getUser()){
    if (\App\Session::getUser()->getId() == $topic->getUser()->getId()||\App\Session::isAdmin()){
        echo "<div class='topicFunctions'><a href='index.php?ctrl=forum&action=editTopicForm&id=".$topicId."'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp
        <a href='index.php?ctrl=forum&action=deleteTopic&id=".$topicId."'><i class='fa-solid fa-trash'></i></a>&nbsp&nbsp";
                
        if($verrouTopic){
            echo "<a href='index.php?ctrl=forum&action=unlockTopic&id=".$topicId."'><i class='fa-solid fa-lock-open'></i></a>";
        }
        else{
            echo "<a href='index.php?ctrl=forum&action=lockTopic&id=".$topicId."'><i class='fa-solid fa-lock'></i></a>";
        }
        echo "</div>";
    } 
}   

foreach($posts as $post){

    echo "<a href='index.php?ctrl=security&action=viewProfile&id=".$post->getUser()->getId()."'>".$post->getUser()."</a><br>";
    echo "(".$post->getDatePost().")<br>";
    echo $post."<br>";
    if(\App\Session::getUser()){
        if (\App\Session::getUser()->getId() == $post->getUser()->getId() || \App\Session::isAdmin()){
            echo "<a href='index.php?ctrl=forum&action=editPostForm&id=".$post->getId()."'><i class='fa-solid fa-pen-to-square'></i></a>";
            if($firstPost->getId() != $post->getId()){ //Pour empêcher que l'on puisse supprimer le premier post d'un topic
                echo "&nbsp&nbsp<a href='index.php?ctrl=forum&action=deletePost&id=".$post->getId()."'><i class='fa-solid fa-trash'></i></a>";
            }
            echo "<br>";
        }
    }
    echo "<br>";
    
}
?>
<?php
if(App\Session::getUser()){
    if(!$verrouTopic || \App\Session::isAdmin()){?>
    <div class="formWrapper">
        <form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method="post" class="formulaireNvPost">
            <p>
                <label>
                    Message :<br>
                    <textarea name="textePost" rows="5" cols="45" class="champTxtPost" required></textarea>        
                </label>
            </p>

            <div class="submitWrapper">
                <input type="submit" name="submit" value="Répondre" class="submit">
            </div>
        </form>
    </div>
<?php }
    else {
        echo "TOPIC VERROUILLÉ ! &nbsp<i class='fa-solid fa-lock'></i>";
    }
} ?>