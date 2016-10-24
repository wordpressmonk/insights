<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchNews */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trending Insights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h4><?php //echo Html::encode($this->title) ?></h4>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'layout' => "{items}\n{pager}",
		'itemView' => '/insight/_view'
	]) ?>
</div>