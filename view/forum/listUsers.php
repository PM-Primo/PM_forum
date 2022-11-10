<?php
$users = $result["data"]['users'];


echo "<h1>Liste des catégories</h1>";

foreach($users as $user){
    echo $user->getPseudoUser()." (".$user->getEmailUser().")<br><br>";
}
?>
