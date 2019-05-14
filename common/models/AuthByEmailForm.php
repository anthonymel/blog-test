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

    /**
     * @var User user
     */
    public $user;
    /**
     * @var Token token
     */
    public $token;

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
        if (!$this->validate()) {
           // $this->addError('username', 'Invalid username or password');
            return false;
        }
        $token = null;
        $identity = User::findOne(['username' => $this->username]);
        if (!\Yii::$app->security->validatePassword($this->password, $identity->password_hash)) {
            $this->addError('username', 'Invalid username or password');
            return false;
        }
        $token = \Yii::$app->security->generateRandomString();
        $accessToken = new Token();
        $accessToken->user_id = $identity->id;
        $accessToken->token = $token;
        if (!$accessToken->save()) {
            $this->addError('token', 'Unable to save token');
            $this->addErrors($accessToken->getErrors());
            return false;
        }
        //$this->user = $user;
        $this->token = $token;
        return true;
    }

}
