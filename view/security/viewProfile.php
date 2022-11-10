<?php
$user = $result["data"]['user'];
$posts = $result["data"]['userPosts'];
?>

<h1>Profil de <?=$user->getPseudoUser()?></h1>

<p>Pseudo : <?=$user->getPseudoUser()?></p>
<p>Adresse mail : <?=$user->getEmailUser()?></p>
<p>Rôle : <?=$user->getRoleUser()?></p>
<p>Nombre de posts : <?=count($posts)?></p>
