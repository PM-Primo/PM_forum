<h1>Edition du message</h1>

<?php
$post = $result["data"]['post'];
$postId = $post->getId();
$textePost = $post->getTextePost();

?>

<div class="formWrapper">
    <form action="index.php?ctrl=forum&action=editPost&id=<?=$postId?>" method="post" class="formulaireNvPost">
                Message :<br>
                <textarea name="nvTextePost" rows="5" cols="45" class="champTxtPost" required ><?php echo $textePost; ?></textarea>        
            </label>
        </p>

        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>