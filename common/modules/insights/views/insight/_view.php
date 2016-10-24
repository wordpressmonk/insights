<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<div class="row insight-item" style="margin:5px;padding:5px;">

	<div class="col-sm-12 col-md-12">

	<div class="row">

		<?=Html::a("$model->title", Url::to(['insight/view', 'id' => $model->id]), [
							'title' => Yii::t('app', "Click to read"),
							'class'=>'heading',
					]); ?>
		<div class="row">
			<div class="col-sm-1 col-md-1">
				<img src="<?=$model->book->image?>" height="50" width="50" class="img-circle" />
			</div>	
			<div class="col-sm-9 col-md-9 bio">
				<?=$model->book->title." | <i><a href='".\Yii::$app->homeUrl."profile/view?id=".$model->user->id."' >".$model->profile->fullname."</a>, ".$model->profile->bio."</i>" ?>
			</div>	
		</div>	
		<div class="row" style="padding: 15px;">
		<?= HtmlPurifier::process(substr($model->text,0,400).'...') ?>  
		</div>

	</div>	
	</div>

</div>