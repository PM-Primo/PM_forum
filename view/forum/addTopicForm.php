<h1>Nouveau Topic</h1>

<?php $catId=$_GET["id"]?>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$catId?>" method="post" class="formulaire">
    <p>
        <label>
            Titre du topic :<br>
            <input type="text" name="titreTopic" class="champ_txt" required>
        </label>
    </p>
    <p>
        <label>
            Message :<br>
            <textarea name="texteFirstPost" rows="5" cols="33" required></textarea>        
        </label>
    </p>

    <div class="submit_wrapper">
        <input type="submit" name="submit" value="Valider" class="submit">
    </div>
        
</form>