<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */

class AuthapiController extends Controller
{
	public function actionAuthByEmail()
	{
		$username = Yii::$app->request->get('username');
		$password = Yii::$app->request->get('password');
		$hasErrors = false;
		$token = null;
		$identity = User::findOne(['username' => $username]);
		if (Yii::$app->security->validatePassword($password, $identity->password_hash)){
			$hasErrors = false;
		}
		else {
			$hasErrors = true;
		}
		if (!$hasErrors) {
			$token = \Yii::$app->security->generateRandomString();;
			Yii::$app->user->loginByAccessToken($identity->auth_key);
		}
		$result = [
			'hasErrors' => $hasErrors,
			'token' => $token,
			'username' => $username,
		];
		$this->goHome();
		//Yii::$app->session->set('token', $token);
		//return json_encode($result);
		//exit();
	}
}