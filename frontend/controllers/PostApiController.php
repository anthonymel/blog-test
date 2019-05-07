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
	public function actionMyPosts()
	{
		$model = new PostListForm();

        if ($model->load(Yii::$app->request->get(), '') && $model->myPosts()) {

            return $this->goBack();
        } else {
            return $this->render('../site/postList', ['model' => $model]);
        }
	}

	public function actionList()
	{
		$model = new PostListForm();

        if ($model->load(Yii::$app->request->get(), '') && $model->list()) {
            return $this->goBack();
        } else {
            return $this->render('../site/postList', ['model' => $model]);
        }
	}

	public function actionCreatePost()
	{
		$model = new CreatePostForm();

        if ($model->load(Yii::$app->request->post()) && $model->createPost()) {

            return $this->goBack();
        } else {
           return $this->render('../site/postList', ['model' => $model]);
        }
	}

}