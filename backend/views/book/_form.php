<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Tag;

use kartik\select2\Select2;
use dosamigos\fileupload\FileUpload;
/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">

	<div class ="card-body">
		<?php $form = ActiveForm::begin([
			'options'=>[
				'class' => 'form',
			]
		]); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>


			<?= FileUpload::widget([
				'model' => $model,
				'attribute' => 'cover_image',
				'url' => ['book/set-cover-image'],
				'options' => [
						'accept' => 'image/*'
				],
				'clientOptions' => [
						'maxFileSize' => 2000000
				],
				'clientEvents' => [
					'fileuploaddone' => 'function(e, data){														
							var dat = JSON.parse(data.result);
							thumbnailUrl = dat.files.thumbnailUrl;
							$("#book-image").val(thumbnailUrl);
							$("#upload_preview").attr("src",thumbnailUrl);
										}',
					'fileuploadfail' => 'function(e, data) {
							console.log(e);
							console.log(data);
						}',
				],
			]);
			?>

			<img id="upload_preview" src="<?=Yii::$app->homeUrl?>img/site/book_icon.png" width="100px" height="100px">
			<?= $form->field($model, 'image')->hiddenInput() ?>

		<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
		
		<?php 
			$data = ArrayHelper::map(Tag::find()->all(), 'tag_id', 'tag_name'); 
		?>
		<?= $form->field($model, 'tags')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Select tags', 'multiple' => true],
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
</div>
