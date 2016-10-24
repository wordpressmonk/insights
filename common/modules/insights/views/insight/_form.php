<?php

/* @var $this yii\web\View */
/* @var $model common\models\Insight */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use common\models\Book;
use common\models\Tag;
use yii\helpers\ArrayHelper;
use dosamigos\fileupload\FileUpload;
?>

<div class="insight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /* echo $form->field($model, 'book_id')
        ->dropDownList(
            $items,           // Flat array ('id'=>'label')
            [//'prompt'=>'--Select--',
			'readonly' => true]    // options
        ); */
	?>
	<?= $form->field($model, 'book_id')->widget(Select2::classname(), [
		'data' => $items,
		'options' => ['placeholder' => '--Select--'],
		'pluginOptions' => [
		//	'allowClear' => true,
			'tags' => true,
			'maximumInputLength' => 100
		],
	]);?>	
	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
		'options' => ['rows' => 6],
		'clientOptions' => [
			'plugins' => [
				"advlist autolink lists link charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		]
	]);?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!--Modal starts here -->
<div class="modal fade" id="book-create-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">
					Great! Add this new book now
				</h4>
			</div>
			<div class="modal-body">
				<div class="book-form">

					<?php 
					$model = new Book();
					$form = ActiveForm::begin([
						'id' => 'add-book-form',
						'enableAjaxValidation'=>true,
                        'validateOnSubmit'=>true
					]); 
					
					?>
			<div class="row">
				<div class="col-md-3">
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
				</div>
				<div  class="col-md-2">
					<img id="upload_preview" src="<?=Yii::$app->homeUrl?>img/site/book_icon.png" width="100px" height="100px">
				</div>					
			</div>
					
					<?= $form->field($model, 'image')->hiddenInput() ?>
					<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'url')->textInput() ?>
					<?= $form->field($model, 'isbn')->textInput() ?>
					<?= $form->field($model, 'description')->textArea() ?>
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


				</div>
			</div>
			<div class="modal-footer">
					<div class="form-group">
						<?= Html::submitButton( 'Create', ['id'=>'book-submit','class' => 'btn btn-primary']) ?>
						<button id="book-add-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> 
					</div>

					<?php ActiveForm::end(); ?>				 
				

			</div>
		</div>
		
	</div>
				
</div>
<script>
$('#insight-book_id').on('select2:select', function (evt) {
  //check if book is there
  var typed = $(this).val();
  $.ajax({
	  url : '<?=Url::to(['book/is-new'])?>'+'?id='+typed,
	  type: 'GET',
	  success:function(data){
		  var data = $.parseJSON(data);
		  console.log(data);
		  if(data.status == "error"){
			  //opens popup
			  console.log("open modal");
			  $('input[id=book-title]').val(typed);
			  $('#book-create-modal').modal('show');

			  //.find('.load-pre').load($(this).attr('href'))
		  }
	  }
  });
});

$('#book-submit').on("click",function(e){
	//e.preventDefault();
	var form = $('#add-book-form');
	//handle the subnission here
	  $.ajax({
		  url : '<?=Url::to(['insight/add-book'])?>',
		  type: 'POST',
		  data: form.serialize(),
		  success:function(data){
			  var data = $.parseJSON(data);
			  $("#insight-book_id").append($('<option>', {value:data.book_id, text: data.title}));
			  $('#insight-book_id').val(data.book_id).trigger("change");
			  form.trigger('reset');
			  $('#book-create-modal').modal('toggle'); 			  
		  }
	  });
	  return false;
});
$('#book-add-cancel').on("click",function(e){
	e.preventDefault();
	$('#insight-book_id').val('').trigger("change");
	form.trigger('reset');
	$('#book-create-modal').modal('toggle'); 	
});
$('.close').on("click",function(e){
	e.preventDefault();
	$('#insight-book_id').val('').trigger("change");
	form.trigger('reset');
	$('#book-create-modal').modal('toggle'); 	
});
</script>
