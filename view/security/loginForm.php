<h1>Se connecter</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=security&action=login" method="post" class="formulaire">
        <p>
            <label>
                Adresse e-mail :<br>
                <input type="text" name="emailUser" class="champTxt" required>
            </label>
        </p>
        <p>
            <label>
                Mot de passe :<br>
                <input type="password" name="mdpUser" class="champTxt" required>
            </label>
        </p>

        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>