<h1>Edition du topic</h1>

<?php
$topic = $result["data"]['topic'];
$titreTopic = $topic->getTitreTopic();
$topicId = $topic->getId();
$firstPost = $result["data"]['firstPost'];
$firstPostTexte = $firstPost->getTextePost();
?>

<form action="index.php?ctrl=forum&action=editTopic&id=<?=$topicId?>" method="post" class="formulaire">
<p>
        <label>
            Titre du topic :<br>
            <input type="text" name="nvTitre" class="champ_txt" value="<?=$titreTopic;?>" required>
        </label>
    </p>
    <p>
        <label>
            Message :<br>
            <textarea name="nvTexte" rows="5" cols="45" required><?=$firstPostTexte;?></textarea>        
        </label>
    </p>

    <div class="submit_wrapper">
        <input type="submit" name="submit" value="Valider" class="submit">
    </div>
        
</form>