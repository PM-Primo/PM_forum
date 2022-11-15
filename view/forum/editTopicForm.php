<h1>Edition du topic</h1>

<?php
$topic = $result["data"]['topic'];
$titreTopic = $topic->getTitreTopic();
$topicId = $topic->getId();
$firstPost = $result["data"]['firstPost'];
$firstPostTexte = $firstPost->getTextePost();
?>

<div class="formWrapper">
    <form action="index.php?ctrl=forum&action=editTopic&id=<?=$topicId?>" method="post" class="formulaireNvPost">
    <p>
            <label>
                Titre du topic :<br>
                <input type="text" name="nvTitre" class="champTxt" value="<?=$titreTopic;?>" required>
            </label>
        </p>
        <p>
            <label>
                Message :<br>
                <textarea name="nvTexte" rows="5" cols="45" class="champTxtPost" required><?=$firstPostTexte;?></textarea>        
            </label>
        </p>

        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>