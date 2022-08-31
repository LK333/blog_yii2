<?php

/** @var yii\web\View $this */
rmrevin\yii\fontawesome\AssetBundle::register($this); /*подключение font awesone для постов*/

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Блог</h1>

        <p class="lead">Поделись своими мыслями.</p>
    </div>
    <h5>В тренде</h5>
    <div class="body-content">
        <!--Блок с тремя самыми популярными постами (зависит от количества лайков)-->
        <div class="row">

            <?php

            foreach ($posts as $post){
            ?>
                <?= $this->render('post', ['post' => $post]) ?> <!--подключение файла с отдельным постом-->
            <?php
            }
            ?>
        </div>

    </div>
</div>
