<?php $title = 'Mon blog';?>

<?php ob_start();?>


<h1>Mot de pass oublié</h1>

<form action="index.php?action=mail" method="POST">

<div class="form-group">

    <label for="">Email</label>

    <input type="email" name="email" class="form-control" required/>

</div>


<button type="submit" class="btn btn-primary">Envoyer</button>

</form>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
