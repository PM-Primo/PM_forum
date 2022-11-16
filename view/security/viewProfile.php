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
            $strTopics = "<a href='index.php?ctrl=forum&action=topicsByUser&id=".$user->getId()."' class='lien'>".$user->getNbTopicsUser()." topics créés</a>";
        }
        else if($user->getNbTopicsUser()==1){
            $strTopics = "<a href='index.php?ctrl=forum&action=topicsByUser&id=".$user->getId()."' class='lien'>1 topic créé</a>";
        }
        else{
            $strTopics = "Aucun topic créé";
        }

        if($user->getNbPostsUser()>1){
            $strPosts = "<a href='index.php?ctrl=forum&action=PostsByUser&id=".$user->getId()."' class='lien'>".$user->getNbPostsUser()." messages rédigés</a>";
        }
        else if($user->getNbPostsUser()==1){
            $strPosts = "<a href='index.php?ctrl=forum&action=PostsByUser&id=".$user->getId()."' class='lien'>1 message rédigé</a>";
        }
        else{
            $strPosts = "Aucun message rédigé";
        }
        ?>
        <li><?=$strTopics?></li>
        <li><?=$strPosts?></li>
    </ul>
    <div class="changeRole">
    <?php
        if(\App\Session::getUser()){
            if($user->getId() != \App\Session::getUser()->getId() && \App\Session::isAdmin()){
                if($user->getRoleUser() != 'Banni'){
                    echo " <a href='index.php?ctrl=security&action=banUser&id=".$user->getId()."' class='lien'>[Bannir]</a>&nbsp&nbsp&nbsp&nbsp";
                }
                else{
                    echo " <a href='index.php?ctrl=security&action=setUser&id=".$user->getId()."' class='lien'>[Dé-bannir]</a>&nbsp&nbsp&nbsp&nbsp";
                }
                if($user->getRoleUser() != 'Admin'){
                    echo " <a href='index.php?ctrl=security&action=setAdmin&id=".$user->getId()."' class='lien'>[Rendre Admin]</a>";
                }
                else{
                    echo " <a href='index.php?ctrl=security&action=setUser&id=".$user->getId()."' class='lien'>[Retirer les fonctions Admin]</a>";
                }
            }
        }
    ?>
    </div>

    <?php 
    if(\App\Session::getUser()){
        if(\App\Session::getUser()->getId() == $user->getId()){
            echo "<div class='submitWrapper'><a href='index.php?ctrl=security&action=changeUserInfoForm&id=".$user->getId()."' class='submit'>Modifier les informations</a>";
            echo "<br><a href='index.php?ctrl=security&action=changeUserMdpForm&id=".$user->getId()."' class='submit'>Modifier le mot de passe</a></div>";
        }
    }
    ?>
</div>