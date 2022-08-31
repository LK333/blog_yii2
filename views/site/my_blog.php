<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Мой блог';
$this->params['breadcrumbs'][] = $this->title;
rmrevin\yii\fontawesome\AssetBundle::register($this); /*подключение font awesone для постов*/
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Описание блога
    </p>

    <?php $form = ActiveForm::begin([
        'id' => 'post',
        'fieldConfig' => [
            'template' => "{input}\n{error}",
            'inputOptions' => ['class' => 'col-lg-6 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => "Название"]) ?>
    <?= $form->field($model, 'text')->textarea(['placeholder' => "Текст"]) ?>
    <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary mb-5', 'name' => 'login-button']) ?>
    <?php ActiveForm::end(); ?>
    <?php
    foreach ($posts as $post){
        ?>
    <div class="row">
        <?= $this->render('post', ['post' => $post]) ?> <!--подключение файла с отдельным постом-->
    </div>
        <?php
    }
    ?>


</div>
</div>
