<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>

<h1><?= $topic ?></h1>

<?php
foreach($posts as $post){

    echo $post->getUser()."<br>";
    echo "(".$post->getDatePost().")<br>";
    echo $post."<br><br>";
    
}

?>