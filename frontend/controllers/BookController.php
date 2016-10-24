<?php

namespace frontend\controllers;

use Yii;
use common\models\Book;
use common\models\Tag;
use common\models\BookTag;
use common\models\search\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionIsNew($id)
    {
		if (($model = Book::findOne($id)) !== null) {
            echo json_encode(['status'=>'success']);
        }
		else {
			echo json_encode(['status'=>'error']);
		}
			
    }	
    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post())) {
		//	print_r($model);die;
			$model->user_id = \Yii::$app->user->id;
			if($model->save()){
				//save tags here
				foreach($model->tags as $tag){
					if(!is_numeric($tag)){
						//save new tag here
						$custom_tag = new Tag();
						$custom_tag->tag_name = $tag;
						if($custom_tag->save(false))
							$tag = $custom_tag->tag_id;
					}
					//find tag and save the booktag map
					$book_tag = new BookTag();
					$book_tag->book_id = $model->book_id;
					$book_tag->tag_id = $tag;
					$book_tag->save(false);
				}
				
				
			}
			return $this->redirect(['insight/create', 'book_id' => $model->book_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->book_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionSetCoverImage(){
		$imageFile = UploadedFile::getInstanceByName('Book[cover_image]');		
		$directory = \Yii::getAlias('@app/web/img/books') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
		if (!is_dir($directory)) {
			mkdir($directory);
		}
		if ($imageFile) {
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if ($imageFile->saveAs($filePath)) {
				$path = Yii::$app->homeUrl.'/img/books/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
				$thmbnail = stripslashes($path);
				return Json::encode([
					'files' => [
						'name' => $fileName,
						'size' => $imageFile->size,
						"url" => $path,
						"thumbnailUrl" => $thmbnail,
						"deleteUrl" => 'image-delete?name=' . $fileName,
						"deleteType" => "POST"
					]
				]);
				
				
			}
		}
		return '';		
	}
}
