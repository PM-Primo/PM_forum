<?php
$user = $result["data"]['user'];
?>

<h1>Profil de <?=$user->getPseudoUser()?></h1>

<div class="listProfil">
    <ul class="detailsProfil">
        <li>Pseudo : <?=$user->getPseudoUser()?></li>
        <li>Adresse mail : <?=$user->getEmailUser()?></li>
        <li>Rôle : <?=$user->getRoleUser()?></li>
        <?php 
        if($user->getNbTopicsUser()>1){
            $strTopics = "<a href='index.php?ctrl=forum&action=topicsByUser&id=".$user->getId()."'>".$user->getNbTopicsUser()." topics créés</a>";
        }
        else if($user->getNbTopicsUser()==1){
            $strTopics = "1 topic créé";
        }
        else{
            $strTopics = "Aucun topic créé";
        }

        if($user->getNbPostsUser()>1){
            $strPosts = "<a href='index.php?ctrl=forum&action=PostsByUser&id=".$user->getId()."'>".$user->getNbPostsUser()." messages rédigés</a>";
        }
        else if($user->getNbPostsUser()==1){
            $strPosts = "1 message rédigé";
        }
        else{
            $strPosts = "Aucun message rédigé";
        }
        ?>
        <li><?=$strTopics?></li>
        <li><?=$strPosts?></li>
    </ul>
</div>