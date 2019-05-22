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


class AuthApiController extends Controller
{
	public $enableCsrfValidation = false;
/*	public $username;
	public $password;
    public $email;*/

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