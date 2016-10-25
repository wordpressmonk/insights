<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="card">
	<div class="card-body">		
		<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

		<p>
			<?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
		</p>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

			//	'book_id',
				'title',
			[
				'attribute' => 'image',
				'format' => 'raw',    
				'value' => function ($data) {
					return Html::img($data['image'],
                ['width' => '70px']);
			},
			],
				'author',
			//	'user_id',
				'url:url',
				'isbn',
				//'image',
				// 'description:ntext',

				['class' => 'yii\grid\ActionColumn'],
			],
		]); ?>
		</div>
</div>
