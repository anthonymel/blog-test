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

    /**
     * @api {get} /frontend/web/post-api/my-posts Вывод записей пользователя.
     * @apiDescription Вывод записей пользователя.
     * @apiName MyPosts
     * @apiGroup Post
     *
     * @apiParam {String} token Token пользователя.
     * @apiParam {String} [limit] Количество возвращаемых записей.
     * @apiParam {String} [offset] Отступ (сколько записей было загружено ранее).
     *
     * @apiSuccess {String[]} result Список публикаций.
     *
     * @apiVersion 0.1.0
     */

	public function actionMyPosts()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->prepareMyPostsQuery()) {
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

    /**
     * @api {get} /frontend/web/post-api/list Вывод всех записей, имеющихся в системе.
     * @apiDescription Вывод всех записей.
     * @apiName List
     * @apiGroup Post
     *
     * @apiParam {String} [limit] Количество возвращаемых записей.
     * @apiParam {String} [offset] Отступ (сколько записей было загружено ранее).
     *
     * @apiSuccess {String[]} result Список публикаций.
     *
     * @apiVersion 0.1.0
     */

	public function actionList()
	{
		$model = new PostListForm();
        $model->load(Yii::$app->request->get(), '');
        if ($model->prepareAllPostQuery()) {
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

    /**
     * @api {post} /frontend/web/post-api/create-post Отправка публикации в систему.
     * @apiDescription Отправка публикации.
     * @apiName CreatePost
     * @apiGroup Post
     *
     * @apiParam {String} token Token пользователя.
     * @apiParam {String} text Текст публикации.
     * @apiParam {String} title Заголовок публикации.
     *
     * @apiSuccess {String} result Token пользователя.
     *
     * @apiVersion 0.1.0
     */

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