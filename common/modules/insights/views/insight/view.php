<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<div id="fb-root"></div>
<script>
/* (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1523780867924637";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1523780867924637";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')); */
</script>
<div class="row insight-item" style="margin:5px;padding:5px;">

	<div class="col-sm-12 col-md-12">

		<div class="row">

			<?=Html::a("$model->title", Url::to(['insight/view','id' => $model->id]), [
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
			<?= HtmlPurifier::process($model->text) ?>  
			</div>

		</div>	
		
	</div>
</div>

<!-- Comments Section -->
<div role="tabpanel" class="col-sm-9 col-md-9" id="comments">
		
	<div class="cardblock-header">	  							
		<h4>Comments(<span id="comment-count"><?php echo count((array)$comments) ?></span>) <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
		<h4 class="comment-input">
			<input type="text" id="comment-input" name="comment-input" class="col-sm-10 col-md-10" placeholder="Share what you're thinking...">
			<?php  
				if(!\Yii::$app->user->isGuest)
					echo '<button id="commentSubmit" class="btn qard col-sm-2 col-md-2 ">POST</button>';
				else 
					echo '<a href="'.Url::to(['site/signup']).'" class="btn qard  col-sm-2 col-md-2" type="button" >Login to Comment</a>';
			?>
			<!--<button id="commentSubmit" class="btn qard col-sm-2 col-md-2">POST</button>-->
		</h4>
	</div>
						
	<ul class="comment-list" >
		<?php foreach($comments as $comment){
			$replies = $comment->replies;
			$reply_count = count((array)$replies);
			//print_r($replies);die;
			//$text = $comment['text'];
			if(count($comment->replies) < 1)
				$r_str = "Add reply";
			else
				$r_str = "View ".$reply_count." Reply";
			$comment_mode_class = '';
			if($comment->status == 0){
				$comment_mode_class = "not-moderated";
				$r_str = '';
			}
				
			echo "
			<li class='col-sm-12 col-md-12 {$comment_mode_class}'>
				<div class='comment-img col-sm-1 col-md-1'>
					<img src='{$comment->commentAuthorProfile->profile_photo}' alt=''>
				</div>
				<div class='comment-txt col-sm-11 col-md-11'>
					<p><strong>{$comment->commentAuthorProfile->fullname}</strong><br>&nbsp;{$comment->text}</p>	  
					<p class='post-date'>Today <a class='view_replies' data-comment_id='{$comment->c_id}'><i>{$r_str}</i></a></p>
				</div>
			</li>
			";
			echo "<div class= 'replies_{$comment->c_id} reply_div'>";
			foreach($comment->replies as $reply){
				if($reply->status == 0){
					$comment_mode_class = "not-moderated";
				}
				echo "
				<li class='col-sm-12 col-md-12 {$comment_mode_class}' >
					<div class='comment-img col-sm-1 col-md-1'>
						<img src='{$reply->commentAuthorProfile->profile_photo}' alt=''>
					</div>
					<div class='comment-txt col-sm-11 col-md-11'>
						<p><strong>{$reply->commentAuthorProfile->fullname}</strong><br>&nbsp;{$reply->text}</p>	  
						<p class='post-date'>Today</p>
					</div></li>
				";				
			}
			echo "</div>";
			echo "<div style='margin-left:15%;display:none' id='reply_input_li_{$comment->c_id}' class='row'><input type='text' data-comment_id = '{$comment->c_id}' id='reply-input{$comment->c_id}'  name='comment-input' class='col-sm-6 col-md-6 form-control reply-input' placeholder='Add a reply'>
			<button data-comment_id ='{$comment->c_id}' class='btn btn-default col-sm-2 col-md-2 replySubmit' >Reply</button></div>";
			
		}?>
	</ul>  
									 
</div>
<?php if(!\Yii::$app->user->isGuest){ ?>
<script>
	$("#commentSubmit").on("click",function(){
		var comment = $("#comment-input");
		if(comment.val() != ''){
			$.ajax({
				url: '<?=Url::to(['insight/add-comment','id'=>$model->id])?>',
				type: 'POST',
				data: {'comment':comment.val()},
				success:function(data){
					console.log(data);
					//load the comment
					var data = $.parseJSON(data);
					var image = '<?=\Yii::$app->user->identity->photo?>';
					var fullname = '<?=\Yii::$app->user->identity->fullname?>';
					//create element
					var li = document.createElement('li');
					li.setAttribute('class', 'col-sm-12 col-md-12 not-moderated');
						var div_first = document.createElement('div');
						div_first.setAttribute('class', 'comment-img col-sm-1 col-md-1');
						var pic = document.createElement('img');
						pic.setAttribute('src', image);
					div_first.appendChild(pic)
					li.appendChild(div_first);
					
					var div_sec = document.createElement('div');
					div_sec.setAttribute('class', 'comment-txt col-sm-11 col-md-11');
					div_sec.innerHTML = "<p><strong>"+fullname+"</strong><br>&nbsp;"+data.text+"</p><p class='post-date'>Today <a class='view_replies' data-comment_id='"+data.c_id+"'><i>Add reply</i></a></p>";
					console.log(div_sec);
					li.appendChild(div_sec);
					$('.comment-list').prepend(li);
				}
			});
		}
	});
	$(".replySubmit").on("click",function(){
		var comment = $("#reply-input"+$(this).attr('data-comment_id'));
		console.log(comment.val());
		console.log($(this).attr('data-comment_id'));
		if(comment.val() != ''){
			$.ajax({
				url: '<?=Url::to(['insight/add-comment','id'=>$model->id])?>'+"&thread_id="+$(this).attr('data-comment_id'),
				type: 'POST',
				data: {'comment':comment.val()},
				success:function(data){
					console.log(data);
					var data = $.parseJSON(data);
					var image = '<?=\Yii::$app->user->identity->photo?>';
					var fullname = '<?=\Yii::$app->user->identity->fullname?>';
					//create element
					var li = document.createElement('li');
					li.setAttribute('class', 'col-sm-12 col-md-12 not-moderated');
						var div_first = document.createElement('div');
						div_first.setAttribute('class', 'comment-img col-sm-1 col-md-1');
						var pic = document.createElement('img');
						pic.setAttribute('src', image);
					div_first.appendChild(pic)
					li.appendChild(div_first);
					var div_sec = document.createElement('div');
					div_sec.setAttribute('class', 'comment-txt col-sm-11 col-md-11');
					div_sec.innerHTML = "<p><strong>"+fullname+"</strong><br>&nbsp;"+data.text+"</p><p class='post-date'>Today <a class='view_replies' ><i>Add reply</i></a></p>";
					//console.log(div_sec);
					li.appendChild(div_sec);
					$('.replies_'+comment.attr('data-comment_id')).append(li);
				}
			});
		}
	});

</script>	
<?php }?>
<script>
	$(".view_replies").on("click",function(){
		var c_id = $(this).attr('data-comment_id');
		$('.replies_'+c_id).toggle();
		$('#reply_input_li_'+c_id).toggle();
	});
</script>
