<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Token;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\base\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */

class AuthApiController extends Controller
{
	public $enableCsrfValidation = false;

	// /**
 //     * {@inheritDoc}
 //     * @see \yii\rest\Controller::behaviors()
 //     */
 //    public function behaviors()
 //    {
 //        $behaviors = parent::behaviors();
    
 //        $behaviors['contentNegotiator'] = [
 //            'class' => ContentNegotiator::className(),
 //            'formats' => [
 //                'application/json' => Response::FORMAT_JSON,
 //            ],
 //        ];
    
 //        return $behaviors;
 //    }

	public function actionAuthByEmail()
	{
		//TODO: use data from \Yii::$app->request->post()

		$username = \Yii::$app->request->get('username');
		$password = \Yii::$app->request->get('password');
		$hasErrors = false;
		$token = null;
		$errorInfo = null;
		$identity = User::findOne(['username' => $username]);
		if (\Yii::$app->security->validatePassword($password, $identity->password_hash)) {
			$hasErrors = false;
		} else {
			$hasErrors = true;
			$errorInfo = "wrong_data";
		}
		if (!$hasErrors) {
			$token = \Yii::$app->security->generateRandomString();
			$accessToken = new Token();
			$accessToken->user_id = $identity->id;
			$accessToken->token = $token;
			if (!$accessToken->save()) $errorInfo = "cant_save_token_to_db";
		}
		$result = [
			'hasErrors' => $hasErrors,
			'token' => $token,
			'username' => $username,
		];
		if ($hasErrors) $result['errorInfo'] = $errorInfo;
		return json_encode($result);
		exit();
	}

	public function actionSignup()
	{
		$username = \Yii::$app->request->get('username');
		$email = \Yii::$app->request->get('email');
		$password = \Yii::$app->request->get('password');
		if (empty($username) || empty($email) || empty($password)){
			$result['errorInfo'] = "wrong_data";
		} else {
			$user = new User();
			$user->username = $username;
			$user->email = $email;
			$user->auth_key = \Yii::$app->security->generateRandomString();
			$user->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
			$user->status = 10;
			if ($user->save()) $result['info'] = "success";
			$token = \Yii::$app->security->generateRandomString();
			$accessToken = new Token();
			$accessToken->user_id = $user->id;
			$accessToken->token = $token;
			if (!$accessToken->save()) $errorInfo = "cant_save_token_to_db";
		}
		return json_encode($result);

	}

}