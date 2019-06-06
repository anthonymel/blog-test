<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $token_id
 * @property int $user_id
 * @property string $token
 */
class Token extends BaseToken 
{

	/**
     * Метод для генерации токена пользователя.
     * @param Object $user Получает пользователя для генерации токена.
     * @return String $accessToken Сгенерированный токен пользователя.
     */

    public static function generateTokenForUser($user)
    {
    	$token = \Yii::$app->security->generateRandomString();
        $accessToken = new Token();
        $accessToken->user_id = $user->id;
        $accessToken->token = $token;
        return $accessToken;
    }

    /**
     * Метод для получения пользователя по его токену.
     * @param Token $tokenString токен пользователя.
     * @return Object $user пользователь, найденный по данному токену.
     */

    public static function getUserByToken($tokenString)
    {
        $token = Token::find()->andwhere(['token.token' => $tokenString])->one();
        if (empty($token)) { 
            return null;
        }
        $user = $token->getUser();
        //$user = User::find()->andwhere(['user.id' => $token->user_id])->one();
        return $user;
    }
}
