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

class AuthByEmailForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
         ];
    }
    public function login()
    {
        $hasErrors = false;
        $token = null;
        $errorInfo = null;
        $identity = User::findOne(['username' => $this->username]);
        if (\Yii::$app->security->validatePassword($this->password, $identity->password_hash)) {
            $hasErrors = false;
        } else {
            $hasErrors = true;
            $errorInfo = "wrong_pass";
        }
        if (!$hasErrors) {
            $token = \Yii::$app->security->generateRandomString();
            $accessToken = new Token();
            $accessToken->user_id = $identity->id;
            $accessToken->token = $token;
            if (!$accessToken->save()) {
                $errorInfo = "cant_save_token_to_db";
            }
        }
        $result = [
            'hasErrors' => $hasErrors,
            'token' => $token,
            'username' => $this->username,
        ];
        if ($hasErrors){
             $result = [
                'errorInfo' => $errorInfo,
            ];
        }
        echo json_encode($result);
        exit;
    }

}
