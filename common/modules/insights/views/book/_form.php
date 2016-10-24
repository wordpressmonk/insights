<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Tag;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
	<?php 
		$data = ArrayHelper::map(Tag::find()->all(), 'tag_id', 'tag_name'); 
	?>
	<?= $form->field($model, 'tags')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Select a state ...', 'multiple' => true],
		'pluginOptions' => [
			'allowClear' => true,
			'tags' => true,
			'maximumInputLength' => 10
		],
	]);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
