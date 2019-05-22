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


class PrivateApiController extends Controller
{
    public function beforeAction($action)
    {
        $token = \Yii::$app->request->get('token');
        if (empty($token)){
            $token = \Yii::$app->request->post('token'); 
        }
        if (self::validateToken($token)){
            \Yii::$app->user->login($identity, 0);
        } 
    }

    public function validateToken($token)
    {
        $tokenInfo = Token::find()->andwhere(['token.token' => $token])->one();
        if (empty($tokenInfo)){
            return false;
        }
        return true;
    }

}