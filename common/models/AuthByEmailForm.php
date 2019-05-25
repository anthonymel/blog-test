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
            return false;
        }
        $token = null;
        $user = User::findOne(['username' => $this->username]);
        if (!\Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            $this->addError('username', 'Invalid username or password');
            return false;
        }
        $accessToken = Token::generateTokenForUser($user);
        if (!$accessToken->save()) {
            $this->addError('token', 'Unable to save token');
            $this->addErrors($accessToken->getErrors());
            return false;
        }
        $this->token = $accessToken->token;
        return true;
    }

}
