<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
$topicId = $topic->getId();
$verrouTopic = $topic->getVerrouTopic();

?>

<h1><?= $topic ?></h1>

<?php
foreach($posts as $post){

    echo $post->getUser()."<br>";
    echo "(".$post->getDatePost().")<br>";
    if(\App\Session::getUser()){
        if (\App\Session::getUser()->getId() == $post->getUser()->getId()){
            echo "<a href='index.php?ctrl=forum&action=editPostForm&id=".$post->getId()."'>Éditer</a> / <a href='index.php?ctrl=forum&action=deletePost&id=".$post->getId()."'>Supprimer</a><br>";
        }
    }
    echo $post."<br><br>";
    
}
?>
<?php
if(App\Session::getUser()){
    if(!$verrouTopic){?>
    <form action="index.php?ctrl=forum&action=addPost&id=<?=$topicId?>" method="post" class="formulaire">
        <p>
            <label>
                Message :<br>
                <textarea name="textePost" rows="5" cols="45" required></textarea>        
            </label>
        </p>

        <div class="submit_wrapper">
            <input type="submit" name="submit" value="Répondre" class="submit">
        </div>
            
    </form>
<?php }
    else {
        echo "TOPIC VERROUILLÉ !";
    }
} ?>