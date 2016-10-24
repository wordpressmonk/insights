<?php

namespace frontend\controllers;

use Yii;
use common\models\Insight;
use common\models\Book;
use common\models\Tag;
use common\models\BookTag;
use common\models\search\InsightSearch;
use common\models\Comments as Comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * InsightController implements the CRUD actions for Insight model.
 */
class InsightController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','add-book'],
                'rules' => [
/*                  [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ], */
                    [
                        'allow' => true,
                        'actions' => ['create','add-book'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Insight models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Insight model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$comments = Comment::find()->where(['insight_id'=>$id,'parent_id'=>0, 'status'=>1])->orderBy('created_at DESC')->all();
		if(!\Yii::$app->user->isGuest){
			$user_comments = Comment::find()->where(['comment_author'=>\Yii::$app->user->id,'insight_id'=>$id,'parent_id'=>0, 'status'=>0])->orderBy('created_at DESC')->all();
			$comments = (object) array_merge( (array)$comments, (array)$user_comments );
		}
			
		foreach($comments as $comment){
			$threads = Comment::find()->where(['parent_id'=>$comment->c_id,'status'=>1])->orderBy('created_at ASC')->all();
				 if(!\Yii::$app->user->isGuest){
					$user_comments = Comment::find()->where(['comment_author'=>\Yii::$app->user->id,'parent_id'=>$comment->c_id, 'status'=>0])->all();
					$threads = (object) array_merge( (array)$threads, (array)$user_comments );
				}	 	
			$comment->replies = $threads;
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
			'comments' => $comments,
        ]);
    }
	public function actionAddBook(){
        $model = new Book();
        if ($model->load(Yii::$app->request->post())) {
		//	print_r($model);die;
			$model->user_id = \Yii::$app->user->id;
			if($model->save(false)){
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
				echo json_encode(Book::find()->where(['book_id'=>$model->book_id])->asArray()->one());
			}
			
        }else
			echo "Error";
	}
    /**
     * Creates a new Insight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($book_id=null)
    {
        $model = new Insight();
		$items = ArrayHelper::map(Book::find()->all(),'book_id','title');
/* 		if($book_id){
			$selected = Book::findOne($book_id);
			if($selected){
				if($selected->user_id != \Yii::$app->user->id)
					throw new ForbiddenHttpException('You are not allowed to access this page.');
				
				$items = ["$book_id"=>"$selected->title"];
			}
				
			else {
            throw new NotFoundHttpException('The requested page does not exist.');
			}			
		} */
        if ($model->load(Yii::$app->request->post()) ) {
			$model->user_id = \Yii::$app->user->id;
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'items'=>$items,
            ]);
        }
    }

    /**
     * Updates an existing Insight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$items = ArrayHelper::map(Book::find()->where(['user_id'=>\Yii::$app->user->id])->all(),'book_id','title');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'items'=>$items,
            ]);
        }
    }

    /**
     * Deletes an existing Insight model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionAddComment($id,$thread_id=null){
		if(Yii::$app->user->isGuest)
			return false;
		if($id){ //insight_id
		//print_R(\Yii::$app->request->post());die;
			$comment = new Comment();
			$comment->insight_id = $id;
			$comment->comment_author = \Yii::$app->user->id;
			if($thread_id)
				$comment->parent_id = $thread_id;
			$comment->text = \Yii::$app->request->post()['comment'];
			if($comment->save(false)){
				$comment_array = Comment::find()->where(['c_id'=>$comment->c_id])->asArray()->one();
				echo json_encode($comment_array);
			}
				
			else echo 'error';
		}
	}
    /**
     * Finds the Insight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Insight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Insight::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
