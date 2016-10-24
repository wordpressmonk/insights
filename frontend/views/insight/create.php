<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Insight */

$this->title = 'Add Insight';
$this->params['breadcrumbs'][] = ['label' => 'Insights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'items'=>$items,
    ]) ?>

</div>
