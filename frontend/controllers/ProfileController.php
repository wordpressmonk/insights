<?php 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\UserProfile as Profile;
use common\models\search\InsightSearch;

/**
 * Profile controller
 */
class ProfileController extends Controller
{
    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
	public function actionView($id){
		if($id == \Yii::$app->user->id)
			return $this->redirect("account");
        $searchModel = new InsightSearch();
        $dataProvider = $searchModel->searchMyInsights(Yii::$app->request->queryParams,$id);
        return $this->render('view_other', [
            'model' => $this->findModel($id),
			'dataProvider' => $dataProvider
        ]);		
	}
	
	public function actionAccount(){
		$id = \Yii::$app->user->id;
        $searchModel = new InsightSearch();
        $dataProvider = $searchModel->searchMyInsights(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
			'dataProvider' => $dataProvider
        ]);		
	}
	/**
	 *
	 */
	public function actionUpdateAjax($id){
        $model = $this->findModel($id);
		//print_r(Yii::$app->request->post());
        if(Yii::$app->request->post()) {
			$model->short_description = Yii::$app->request->post()['short_description'];
			$model->fullname = Yii::$app->request->post()['fullname'];
			$model->bio = Yii::$app->request->post()['bio'];
			if($model->save()){
				echo json_encode(Yii::$app->request->post());
			}
        } else {
            return false;
        }		
	}
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::find()->where(['user_id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>