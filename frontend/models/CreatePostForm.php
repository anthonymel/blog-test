<?php

namespace frontend\models;

use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\base\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\Token;
use common\models\Post;

class CreatePostForm extends Model
{
    public $text;
    public $title;
    public $token;

    public function rules()
    {
        return [
            [['text', 'title', 'token'], 'required'],
            ['title', 'string', 'min' => 10, 'max' => 50],
            ['text', 'string', 'min' => 10],
         ];
    }

    public function createPost()
    {
        if (!$this->validate()) {
            return false;
        }
        $result = null;
        $tokenInfo = Token::find()->andwhere(['token.token' => $this->token])->one();
        //TODO: validate $tokenInfo
        $post = new Post();
        $post->text = $this->text;
        $post->title = $this->title;

        $user = \Yii::$app->user->getIdentity();

        $post->author_id = $tokenInfo->user_id;
        $post->date = time();
        if (!$post->save());{
            $this->addError('user', 'Unable to save post');
        }
        return true;
    }
   
}