<?php 
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = 'Profile';
//print_r($model);
?>
<div class="container-fluid" >
	<div class="row" style="border: gray dotted 2px;padding:5px">
		<div class="col-md-3">
			<img src="<?=$model->profile_photo?>" height="200" width="200" class="img-circle" />
		</div>
		<div class="col-md-9">
			<h3 class="text-primary">
					<div class="preview row">
						<div class="preview-block col-md-10" id="name_preview">
							<?php echo ($model->fullname!='')?$model->fullname.' ':'Fullname ' ?>
						</div>
					</div>
			</h3>
			<blockquote>
			<p class="text-primary">
					<div class="preview row">
						<div class="preview-block col-md-10" id="desc_preview">
							<?php echo ($model->bio!='')?$model->bio.' ':'Edit Bio ' ?>
						</div> 
					</div>
			</p><small><cite>Bio</cite></small>
			</blockquote>

				<p>
					<div class="preview row">
						<div class="preview-block col-md-10" id="bio_preview">
							<?php echo ($model->short_description!='')?$model->short_description.' ':'Tell us something about yourself ' ?>
						</div>
					</div>
				</p>

		</div>
	</div>
	<div class="row" style="border: gray dotted 2px;padding:5px;margin-top:15px">
		<div class="col-md-3">
			<ul class="nav nav-stacked nav-pills">
				<li class="active">
					<a href="#">Insights</a>
				</li>

			</ul>
		</div>
		<div class="col-md-9">

			<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemOptions' => ['class' => 'item'],
				'layout' => "{summary}\n{items}\n{pager}",
				'itemView' => '/insight/_view'
			]) ?>
		</div>
	</div>
</div>
