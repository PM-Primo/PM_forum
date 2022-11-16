<?php
$posts = $result["data"]['posts'];
$user = $result["data"]['user'];
?>

<a href="index.php?ctrl=security&action=viewProfile&id=<?= $user->getId() ?>" class='lien'><i class="fa-solid fa-arrow-left"></i> Profil de <?= $user?></a>
<h1>Messages rédigés par <?=$user?></h1>

<?php
foreach($posts as $post){
    echo "<a href='index.php?ctrl=forum&action=listTopics&id=".$post->getTopic()->getCategorie()->getId()."' class='lien'>".$post->getTopic()->getCategorie()."</a> / ";
    echo "<a href='index.php?ctrl=forum&action=listPosts&id=".$post->getTopic()->getId()."' class='lien'>".$post->getTopic()."</a><br>";
    echo "(".$post->getDatePost().")<br>";
    echo $post."<br><br>";
}
?>