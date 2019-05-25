<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Token;
use common\models\AuthByEmailForm;
use common\models\SignupByEmailForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\base\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



//http://apidocjs.com
//apidoc -f ".*\\.php$" -i frontend -o frontend/web/api-doc


class AuthApiController extends Controller
{
	public $enableCsrfValidation = false;

    /**
     * @api {post} /frontend/web/auth-api/auth-by-email Авторизация пользователя по username.
     * @apiDescription Авторизация пользователя по username.
     * @apiName AuthByEmail
     * @apiGroup Auth
     *
     * @apiParam {String} username Имя пользователя.
     * @apiParam {String} password пароль пользователя.
     *
     * @apiSuccess {String} username Имя пользователя.
     * @apiSuccess {String} accessToken Токен доступа.
     *
     * @apiVersion 0.1.0
     */

	public function actionAuthByEmail()
	{
		$model = new AuthByEmailForm();
		$model->load(Yii::$app->request->post(), '');
        if ($model->login()) {
        	$result = [
        		'username' => $model->username,
        		'token' => $model->token,
        	];
			echo json_encode($result);
			exit;
        } else {
        	$result = [
                'errors' => $model->getErrors(),
            ];
        	echo json_encode($result);
        	//return $this->render('../site/enter', ['model' => $model]);
        	exit;
        }
		
	}

    /**
     * @api {post} /frontend/web/auth-api/signup Регистрация пользователя.
     * @apiDescription Регистрация пользователя.
     * @apiName Signup
     * @apiGroup Auth
     *
     * @apiParam {String} username Имя пользователя.
     * @apiParam {String} email Email пользователя.
     * @apiParam {String} password Пароль пользователя.
     *
     * @apiSuccess {String} username Имя пользователя.
     * @apiSuccess {String} accessToken Токен доступа.
     *
     * @apiVersion 0.1.0
     */

	public function actionSignup()
	{
		$model = new SignupByEmailForm();
		$model->load(Yii::$app->request->post(), '');
        if ($model->signup()) {
            $result = [
                'username' => $model->username,
                'token' => $model->token,
            ];
            echo json_encode($result);
			exit;
        } else {
            $result = [
                'errors' => $model->getErrors(),
            ];
            echo json_encode($result);
           // return $this->render('../site/signup_', ['model' => $model]);
            exit;
        }
	}
}