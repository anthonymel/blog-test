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




class PostApiController extends PrivateApiController
{
    public $enableCsrfValidation = false;

    /**
     * @api {get} /frontend/web/post-api/my-posts Вывод записей пользователя.
     * @apiDescription Вывод записей пользователя.
     * @apiName MyPosts
     * @apiGroup Post
     *
     * @apiUse token
     * @apiParam {String} [limit] Количество возвращаемых записей.
     * @apiParam {String} [offset] Отступ (сколько записей было загружено ранее).
     *
     * @apiUse PostSuccess
     *
     * @apiUse WrongToken
     *
     * @apiVersion 0.1.0
     */

	public function actionMyPosts()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->prepareMyPostsQuery()) {
            $result = [
                "posts" => Post::formatQueryAsArray($model->postQuery),
            ];
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

    /**
     * @api {get} /frontend/web/post-api/list Вывод всех записей, имеющихся в системе.
     * @apiDescription Вывод всех записей.
     * @apiName List
     * @apiGroup Post
     *
     * @apiParam {String} [limit] Количество возвращаемых записей.
     * @apiParam {String} [offset] Отступ (сколько записей было загружено ранее).
     *
     * @apiUse PostSuccess
     *
     * @apiVersion 0.1.0
     */

	public function actionList()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->prepareAllPostQuery()) {
            $result = [
                "posts" => Post::formatQueryAsArray($model->postQuery),
            ];
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

    /**
     * @api {post} /frontend/web/post-api/create-post Отправка публикации в систему.
     * @apiDescription Отправка публикации.
     * @apiName CreatePost
     * @apiGroup Post
     *
     * @apiUse token
     * @apiParam {String} text Текст публикации.
     * @apiParam {String} title Заголовок публикации.
     *
     * @apiUse PostCreateSuccess
     *
     * @apiUse WrongToken
     *
     * @apiVersion 0.1.0
     */

	public function actionCreatePost()
	{
		$model = new CreatePostForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->createPost()) {
            $result = [
                "text" => $model->text,
                "title" => $model->title,
            ];
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
}