<h1>Edition du message</h1>

<?php
$post = $result["data"]['post'];
$postId = $post->getId();
$textePost = $post->getTextePost();

?>

<form action="index.php?ctrl=forum&action=editPost&id=<?=$postId?>" method="post" class="formulaire">
            Message :<br>
            <textarea name="nvTextePost" rows="5" cols="45" required><?php echo $textePost; ?></textarea>        
        </label>
    </p>

    <div class="submit_wrapper">
        <input type="submit" name="submit" value="Valider" class="submit">
    </div>
        
</form>