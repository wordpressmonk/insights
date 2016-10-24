<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
	
	<span>					
		<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/index'; ?>"><button class="btn btn-primary"><i class="fa fa-facebook"></i>Connect With Facebook</button></a>
					
		<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/signin'; ?>"><button class="btn btn-info"><i class="fa fa-twitter"></i>Connect With Twitter</button></a>
		<a href="<?=\Yii::$app->homeUrl?>site/login">Already a user?Sign In here</a>
	</span>

	
    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
		

    </div>
</div>
