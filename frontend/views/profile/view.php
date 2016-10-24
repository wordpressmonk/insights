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
						<span class="edit-icon glyphicon glyphicon-pencil"></span>
						<div class="input-block col-md-12" style="display:none" >
							<div class="col-md-8">
								<input class="form-control" id="name" type="text" name="UserProfile[fullname]" value="<?=$model->fullname?>" />
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-link" type="button" onClick="cancel();return false;">Cancel</a>
								<a href="#" class="btn btn-primary" type="button" onClick="update();return false;">Update</a>
							</div>
						</div>
						
					</div>
			</h3>
			<blockquote>
			<p class="text-primary">
					<div class="preview row">
						<div class="preview-block col-md-10" id="desc_preview">
							<?php echo ($model->bio!='')?$model->bio.' ':'Edit Bio ' ?>
						</div>
						<span class="edit-icon glyphicon glyphicon-pencil"></span>
						<div class="input-block col-md-12" style="display:none" >
							<div class="col-md-8">
								<input class="form-control" id="desc" type="text" name="desc" value="<?=$model->bio?>" />
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-link" type="button" onClick="cancel();return false;">Cancel</a>
								<a href="#" class="btn btn-primary" type="button" onClick="update();return false;">Update</a>
							</div>
						</div>
						 
					</div>
			</p><small><cite>Bio</cite></small>
			</blockquote>

				<p>
					<div class="preview row">
						<div class="preview-block col-md-10" id="bio_preview">
							<?php echo ($model->short_description!='')?$model->short_description.' ':'Tell us something about yourself ' ?>
						</div>
						<span class="edit-icon glyphicon glyphicon-pencil"></span>
						<div class="input-block col-md-12" style="display:none" >
							<div class="col-md-8">
								<input class="form-control" id="bio" type="text" name="UserProfile[short_description]" value="<?=$model->short_description?>" />
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-link" type="button" onClick="cancel();return false;">Cancel</a>
								<a href="#" class="btn btn-primary" type="button" onClick="update();return false;">Update</a>
							</div>
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
<script>
$(".preview").mouseover(function(){
	if($(this).find(".input-block").is(':visible')) {
		$(this).find(".edit-icon").hide();
	}else{
		$(this).find(".edit-icon").show();
	}	
}).mouseout(function() {
    $(this).find(".edit-icon").hide();
});
$(".preview .edit-icon").on("click",function(){
	$(this).find(".edit-icon").hide();
	$(this).parent('div').find(".preview-block").hide();
	$(this).parent('div').find(".input-block").show();
});
function update(){
	var data = {};
	data.short_description = $("#bio").val();
	data.fullname = $("#name").val();
	data.bio = $("#desc").val();
	$.ajax({
		url : "<?=Url::to(['profile/update-ajax','id'=>$model->user_id], true)?>",
		type: "POST",
		data : data,
		success : function(data){
			console.log(data);
			var json = $.parseJSON(data);
			//update preview values
			$("#bio_preview").html(json.short_description);
			$("#name_preview").html(json.fullname);
			$("#desc_preview").html(json.bio);
			
			$(".preview-block").show();
			$(".input-block").hide();
		}
	});
}
function cancel(){
	$(".preview-block").show();
	$(".input-block").hide();	
}
</script>