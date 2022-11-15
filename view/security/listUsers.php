<?php
$users = $result["data"]['users'];


echo "<h1>Liste des utilisateurs</h1>";

foreach($users as $user){
    echo "<a href='index.php?ctrl=security&action=viewProfile&id=".$user->getId()."'>".$user->getPseudoUser()."</a> (".$user->getEmailUser().")<br><br>";
}
?>
