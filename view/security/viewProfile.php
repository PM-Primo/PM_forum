<?php
$user = $result["data"]['user'];
?>

<h1>Profil de <?=$user->getPseudoUser()?></h1>

<p>Pseudo : <?=$user->getPseudoUser()?></p>
<p>Adresse mail : <?=$user->getEmailUser()?></p>
<p>Rôle : <?=$user->getRoleUser()?></p>
<!--<p>Nombre de posts : <?=count($posts)?></p>-->
