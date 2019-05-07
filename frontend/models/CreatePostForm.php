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
        /*$token = \Yii::$app->request->get('access-token');
        $text = \Yii::$app->request->get('text');
        $title = \Yii::$app->request->get('title');*/
        $result = null;
        $tokenInfo = Token::find()->andwhere(['token.token' => $this->token])->one();
        $post = new Post();
        $post->text = $this->text;
        $post->title = $this->title;
        $post->author_id = $tokenInfo->user_id;
        $post->date = \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        $post->save();
        $result = [
            'info' => "success",
        ];
        echo json_encode($result);
        exit;

    }
   
}