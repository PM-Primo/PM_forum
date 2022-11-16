<?php
$users = $result["data"]['users'];


echo "<h1>Liste des utilisateurs</h1>";

foreach($users as $user){
    echo "<a href='index.php?ctrl=security&action=viewProfile&id=".$user->getId()."' class='lien'>".$user->getPseudoUser()."</a> (".$user->getEmailUser().") : ";
    echo $user->getRoleUser();
    echo "<br><br>";
}
?>
