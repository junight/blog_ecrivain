
<?php

session_start();

/* require 'inc/functions.php'; */

var_dump($_POST);

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<h1>Réinitialisation du mot de passe</h1>

<form action='index.php?action=resetPassword&id=<?=$id;?>&token=<?=$token;?>'  method="POST">
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Nouveau de mot de passe">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmez le nouveau mot de passe">
    </div>

    <button class="btn btn-primary">Réinitialiser le mot de passse</button>
</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>


