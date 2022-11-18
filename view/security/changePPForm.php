<h1> Uploader une nouvelle photo de profil</h1>

<div class="formWrapper">
    <form action="index.php?ctrl=security&action=changePP&id=<?=$_GET["id"]?>" method="post" enctype= "multipart/form-data" class="formulaireNvPost">
        <p class="ppUploader">
            <label>
                <input type="file" name="nvPP" >
            </label>
        </p>

        <div class="submitWrapper">
            <a href="index.php?ctrl=security&action=cancelChangeUserinfo&id=<?=$_GET["id"];?>" class="submit">Annuler</a>&nbsp&nbsp
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
        
    </form>
</div>