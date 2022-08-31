<?php

$author = \app\models\User::findIdentity($post->author);

?>

<div class="col-lg-4">

    <h2><?= $post->name ?></h2>
    <p class="author-name"><i class="fa fa-user"></i> <?= $author->username ?></p>
    <p><?= $post->text ?></p>
    <div class="interaction pull-right">
        <a href="#"><i class="fa fa-share"></i></a>
        <a href="#"><i class="fa fa-retweet"></i> <?= $post->reposts ?> </a>
        <a href="#"><i class="fa fa-heart"></i> <?= $post->likes ?></a>
    </div>
</div>




