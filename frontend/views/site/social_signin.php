<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign UP';
$this->params['breadcrumbs'][] = $this->title;
 ?>  
<section class="home-main content">
		<div class="signup">
			<h3>Sign In/Sign Up</h3>
			<p>Choose how you want to do it</p> 
			<div class="sign-buttons">
				<p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/index'; ?>"><button class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Sign In/Sign Up with facebook</button></a></p>
				<p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/signin'; ?>"><button class="btn btn-lg btn-info"><i class="fa fa-twitter"></i> Sign In/Sign Up with Twitter</button></a></p>
				<p><button class="btn btn-lg btn-default" onclick="location.href='<?=\Yii::$app->homeUrl?>site/signup';"><i class="fa fa-envelope"></i> Sign In/Sign Up with Email</button></p>
			</div>
			<p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up.</p>
		</div>
</section>