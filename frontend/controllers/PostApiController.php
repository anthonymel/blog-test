<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\User;
use common\models\Token;
use frontend\models\CreatePostForm;
use frontend\models\PostListForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\Serializer;


class PostApiController extends Controller
{
    public $enableCsrfValidation = false;
	public function actionMyPosts()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->myPosts()) {
            echo json_encode($model->result);
            exit;            
        } else {
            echo json_encode($model->getErrors());
            exit;
        }
	}

	public function actionList()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->list()) {
            echo json_encode($model->result);
            exit;            
        } else {
            echo json_encode($model->getErrors());
            exit;
        }
	}

	public function actionCreatePost()
	{
		$model = new CreatePostForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->createPost()) {
            echo json_encode($model->token);            
        } else {
            echo json_encode($model->getErrors());
            exit;
        }
    }
}