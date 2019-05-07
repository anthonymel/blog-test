<?php

namespace common\models;

use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\base\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\Token;

class SignupByEmailForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
         ];
    }

    public function signup()
    {
/*        $username = \Yii::$app->request->get('username');
        $email = \Yii::$app->request->get('email');
        $password = \Yii::$app->request->get('password');*/
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->status = 10;
        if ($user->save()){
            $result = [
                'info' => "success",
            ];
        }
        $token = \Yii::$app->security->generateRandomString();
        $accessToken = new Token();
        $accessToken->user_id = $user->id;
        $accessToken->token = $token;
        if (!$accessToken->save()){
            $errorInfo = "cant_save_token_to_db";
        }
        echo json_encode($result);
        exit;
    }
}