<?php $user = $result["data"]['user'];?>


<h1>Modifier les informations</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=security&action=changeUserInfo&id=<?=$user->getId()?>" method="post" class="formulaire">
        <p>
            <label>
                Adresse e-mail :<br>
                <input type="text" name="emailUser" class="champTxt" value="<?=$user->getEmailUser();?>"  required>
            </label>
        </p>
        <p>
            <label>
                Pseudo :<br>
                <input type="text" name="pseudoUser" class="champTxt" value="<?=$user->getPseudoUser();?>" required>
            </label>
        </p>

        <div class="submitWrapper">
            <a href="index.php?ctrl=security&action=cancelChangeUserinfo&id=<?=$user->getId();?>" class="submit">Annuler</a>&nbsp&nbsp
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>