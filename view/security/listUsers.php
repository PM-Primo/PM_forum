<?php
$users = $result["data"]['users'];


echo "<h1>Liste des utilisateurs</h1>";

foreach($users as $user){
    echo "<a href='index.php?ctrl=security&action=viewProfile&id=".$user->getId()."'>".$user->getPseudoUser()."</a> (".$user->getEmailUser().") : ";
    echo $user->getRoleUser();
    if($user->getId() != \App\Session::getUser()->getId()){
        if($user->getRoleUser() != 'Banni'){
            echo " <a href='index.php?ctrl=security&action=banUser&id=".$user->getId()."'>[Bannir]</a>";
        }
        else{
            echo " <a href='index.php?ctrl=security&action=unbanUser&id=".$user->getId()."'>[Dé-bannir]</a>";
        }
    }
    echo "<br><br>";
}
?>
