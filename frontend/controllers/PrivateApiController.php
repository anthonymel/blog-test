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

    /**
     * Метод, который выполняется перед каким-либо action'ом.
     * Получает и проверяет токен, ищет по нему пользователя.
     * @param Действие $action которое должно быть выполнено.
     * @return true/false Должно ли выполниться действие (action).
     */

    public function beforeAction($action)
    {
        if ($this->checkPublicApiActions()) { 
            return true;
        }
        $token = $this->getToken();
        if (empty($token)) {
            $result = [
                'error' => 'Empty token',
            ];
            echo json_encode($result); 
            exit;
        }
        $user = Token::getUserByToken($token);
        if (empty($user)) { 
            return false;
        }
        \Yii::$app->user->login($user, 0);
        return true;
    }

    /**
     * Метод для получения токена.
     * Получает токен из get, в случае неудачи берет токен из post.
     * @return Token $token Токен пользователя.
     */

    public function getToken()
    {
        $token = \Yii::$app->request->get('token');
        if (empty($token)) {
            $token = \Yii::$app->request->post('token'); 
        }
        return $token;
    }

    /**
     * Функция, проверяющая публичные API.
     * @return true/false Является ли API публичным.
     */

    public function checkPublicApiActions()
    {
        $publicApiList = ['list'];
        if (in_array($this->action->id, $publicApiList)) {
            return true;
        }
        return false;
    }

    /**
     * @apiDefine PostSuccess
     * @apiSuccess {Object[]} posts Список публикаций. 
     * @apiSuccess {Int} posts.id ID публикации. 
     * @apiSuccess {String} posts.text Текст публикации. 
     * @apiSuccess {String} posts.title Заголовок публикации.
     * @apiSuccess {Date} posts.date Дата публикации.
     */

    /**
     * @apiDefine PostCreateSuccess
     * @apiSuccess {Object[]} post Созданная публикация. 
     * @apiSuccess {Int} posts.id ID публикации. 
     * @apiSuccess {String} posts.text Текст публикации. 
     * @apiSuccess {String} posts.title Заголовок публикации.
     * @apiSuccess {Date} posts.date Дата публикации.
     */

    /**
     * @apiDefine token 
     * @apiParam {String} token Token пользователя.
     */

    /**
     * @apiDefine CreateUser
     * @apiParam {String} username Имя пользователя.
     * @apiParam {String} password пароль пользователя.
     * @apiSuccess {String} username Имя пользователя.
     * @apiSuccess {String} accessToken Токен доступа.
     */

     /**
     * @apiDefine WrongToken 
     * @apiError WrongToken Неверный токен
     */
}