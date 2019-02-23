<?php

/* session_start(); */

/* require './inc/functions.php'; */

/* logged_only(); */

?>

<?php $title = 'Mon blog';?>

<?php ob_start();?>

<?php

// On récupère l'article

foreach ($posts as $post) {
    ?>
    <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=$post->title;?>
            <em>le <?=$post->date_creation_fr;?></em>
        </h3>

        <p>
            <?=
    // On affiche le contenu du billet
    nl2br($post->content);
    ?>
        <br/>
        </p>
    </div>
    <?php

} // Fin de la boucle des billets
$post->closeCursor();

// Récupération des commentaires

foreach ($comments as $comment) {
    ?>
    <div class="comment">
        <div class="comment-heading">

            <form action="index.php?action=rateComment&commentId=<?=$comment->id;?>&postId=<?=$_GET['id'];?>" method="POST">
                    <input type="submit" id=commentButton name="commentButton"  value=&radic;  >
                    <input type="hidden" id=commentId name="commentId"  value=<?=$comment->id;?>  >
            </form>

                <strong>
                    <?=htmlspecialchars($comment->author);?>
                </strong>
                le <?=$comment->date_comment_fr;?>

               <strong>+<?=$comment->rating_comment?> Votes</strong>
    </div>
        <?=nl2br(htmlspecialchars($comment->comment));?>
    </div>
    <?php
}
?>
<?php
if ($_SESSION && $_SESSION['auth']): ?>
<h4>Laissez un commentaire</h4>
<form action="index.php?action=addComment&amp;id=<?=$_GET['id']?>" method="POST">
    <div class="form-group">
        <textarea class="form-control" name="comment" placeholder="Contenu du commentaire"></textarea>
        <div class="invalid-feedback">
            Veuillez ajouter un nom valide.
        </div>
    </div>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php endif;?>

<?php $content = ob_get_clean();?>

<?php require 'template.php';?>
