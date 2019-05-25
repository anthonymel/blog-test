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
use yii\helpers\ArrayHelper;


class PrivateApiController extends Controller
{
    public $publicApiList = ['list'];

    public function beforeAction($action)
    {
        if (in_array($action->id, $this->publicApiList)){
            return true;
        }
        $token = $this->getToken();
        if (!empty($token)){
            $user = $this->getUserByToken($token);
        } else {
            $result = [
                'error' => 'Empty token',
            ];
            echo json_encode($result); 
            exit;         
        }
        if (!empty($user)){
            \Yii::$app->user->login($user, 0);
            return true;
        }
    }

    public function getToken()
    {
        $token = \Yii::$app->request->get('token');
        if (empty($token)){
            $token = \Yii::$app->request->post('token'); 
        }
        return $token;
    }

    public function getUserByToken($token)
    {
        $tokenInfo = Token::find()->andwhere(['token.token' => $token])->one();
        if (empty($tokenInfo)){
            $result = [ 
                'error' => 'Wrong token',
            ];
            echo json_encode($result);
            exit;
        } else {
            $user = User::find()->andwhere(['user.id' => $tokenInfo->user_id])->one();
            return $user;
        }
    }

}