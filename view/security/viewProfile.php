<?php
$user = $result["data"]['user'];
?>

<h1>Profil de <?=$user->getPseudoUser()?></h1>

<div class="detailsProfil">
    <p>Pseudo : <?=$user->getPseudoUser()?></p>
    <p>Adresse mail : <?=$user->getEmailUser()?></p>
    <p>Rôle : <?=$user->getRoleUser()?></p>
    <?php 
    if($user->getNbTopicsUser()>1){
        $strTopics = $user->getNbTopicsUser()." topics créés";
    }
    else if($user->getNbTopicsUser()==1){
        $strTopics = "1 topic créé";
    }
    else{
        $strTopics = "Aucun topic créé";
    }

    if($user->getNbPostsUser()>1){
        $strPosts = $user->getNbPostsUser()." messages rédigés";
    }
    else if($user->getNbPostsUser()==1){
        $strPosts = "1 message rédigé";
    }
    else{
        $strPosts = "Aucun message rédigé";
    }
    ?>
    <p><?=$strTopics?></p>
    <p><?=$strPosts?></p>
</div>