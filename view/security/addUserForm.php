<h1>Formulaire d'inscription</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=security&action=addUser" method="post" class="formulaire">
        <p>
            <label>
                Adresse e-mail :<br>
                <input type="text" name="emailUser" class="champTxt" required>
            </label>
        </p>
        <p>
            <label>
                Pseudo :<br>
                <input type="text" name="pseudoUser" class="champTxt" required>
            </label>
        </p>
        <p>
            <label>
                Mot de passe :<br>
                <input type="password" name="mdpUser" class="champTxt" minlength="8" required>
            </label>
        </p>
        <p>
            <label>
                Confirmer le mot de passe :<br>
                <input type="password" name="mdpUser2" class="champTxt" minlength="8" required>
            </label>
        </p>

        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>