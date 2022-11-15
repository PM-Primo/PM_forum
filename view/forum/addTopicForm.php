<h1>Nouveau Topic</h1>

<?php $catId=$_GET["id"]?>
<div class="formWrapper">
    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$catId?>" method="post" class="formulaireNvPost">
        <p>
            <label>
                Titre du topic :<br>
                <input type="text" name="titreTopic" class="champTxt" required>
            </label>
        </p>
        <p>
            <label>
                Message :<br>
                <textarea name="texteFirstPost" rows="5" cols="33" required class="champTxtPost"></textarea>        
            </label>
        </p>

        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>