<?php

namespace common\modules\insights\controllers;

use Yii;
use common\models\Insight;
use common\models\search\InsightSearch;

class FeedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new InsightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('feed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
