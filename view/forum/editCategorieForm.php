<?php $categorie = $result["data"]['categorie'];?>

<h1>Édition de la catégorie</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=forum&action=editCategorie&id=<?=$categorie->getId()?>" method="post" class="formulaire">
        <p>
            <label>
                Nom de la catégorie :<br>
                <input type="text" name="nvTitreCat" class="champTxt" value="<?=$categorie->getNomCategorie();?>" required>
            </label>
        </p>
        <div class="submitWrapper">
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>