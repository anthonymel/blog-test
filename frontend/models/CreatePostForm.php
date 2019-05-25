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
        $user = \Yii::$app->user->getIdentity();
        if (empty($user)) {
            $this->addError('token', 'Wrong token');
            return false;
        }
        $post = new Post();
        $post->text = $this->text;
        $post->title = $this->title;
        $post->author_id = $user->id;
        $post->date = time();
        if (!$post->save());{
            $this->addError('user', 'Unable to save post');
        }
        return true;
    }
   
}