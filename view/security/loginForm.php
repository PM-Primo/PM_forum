<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login" method="post" class="formulaire">
    <p>
        <label>
            Adresse e-mail :
            <input type="text" name="emailUser" class="champ_txt">
        </label>
    </p>
    <p>
        <label>
            Mot de passe :
            <input type="password" name="mdpUser" class="champ_txt">
        </label>
    </p>

    <div class="submit_wrapper">
        <input type="submit" name="submit" value="Valider" class="submit">
    </div>
        
</form>