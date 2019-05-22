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


//TODO: extends from PrivateApiController

//TODO: use https://www.yiiframework.com/doc/api/2.0/yii-base-controller#beforeAction()-detail
//beforeAction. Extact token from get. If emtpy, extract from post. Validate. Save user \Yii::$app->user->login($identity, 0);
//

class PostApiController extends PrivateApiController
{
    public $enableCsrfValidation = false;

	public function actionMyPosts()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->getMyPostsQuery()) {
            $result = $model->formatQueryAsArray($model->postQuery);
            echo json_encode($result);
            exit;            
        } else {
            $result = [
                'errors' => $model->getErrors(),
            ];
            echo json_encode($result);
            exit;
        }
	}

	public function actionList()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->getAllPostQuery()) {
            $result = $model->formatQueryAsArray($model->postQuery);
            echo json_encode($result);
            exit;            
        } else {
            $result = [
                'errors' => $model->getErrors(),
            ];
            echo json_encode($result);
            exit;
        }
	}

	public function actionCreatePost()
	{
		$model = new CreatePostForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->createPost()) {
            $result = [
                'token' => $model->token,
            ];
            echo json_encode($result);            
        } else {
            $result = [
                'errors' => $model->getErrors(),
            ];
            echo json_encode($result);
            exit;
        }
    }
}