<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'book_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
