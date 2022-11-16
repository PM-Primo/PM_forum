<h1>Modifier le mot de passe</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=security&action=changeUserMdp&id=<?=$_GET["id"]?>" method="post" class="formulaire">

        <p>
            <label>
                Nouveau mot de passe :<br>
                <input type="password" name="mdpUser" class="champTxt" minlength="8" required>
            </label>
            <div class="tinyTxt">8 caractères minimum</div>
        </p>
        <p>
            <label>
                Confirmer le mot de passe :<br>
                <input type="password" name="mdpUser2" class="champTxt" minlength="8" required>
            </label>
        </p>

        <div class="submitWrapper">
            <a href="index.php?ctrl=security&action=cancelChangeUserinfo&id=<?=$_GET["id"]?>" class="submit">Annuler</a>
            &nbsp&nbsp
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>