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

class PostListForm extends Model
{
    public $limit;
    public $offset;
    public $token;
    public $result;

    public function rules()
    {
        return [
            [['limit'], 'default', 'value' => 10],
            [['offset'], 'default', 'value' => 0],
            ['token', 'string', 'min' => 10]
            //[['result'], 'default', 'value' => 0]
        ];
    }

    public function myPosts()
    {
        if (!$this->validate()) {
            return false;
        }
        $tokenInfo = Token::find()->andwhere(['token.token' => $this->token])->one();
        if (empty($tokenInfo)) {
            $this->addError('token', 'Wrong token');
            return false;
        }
        $postQuery = Post::find()
            ->andwhere(['post.author_id' => $tokenInfo->user_id])
            ->limit($this->limit)
            ->offset($this->offset);
        if (empty($postQuery)) {
            $this->addError('query', 'Can`t find posts');
            return false;
        }
        //$result = [];
        foreach ($postQuery->each() as $post) {
            //$post = new Serializer;
            $this->result[] = serialize($post);
        }
        return true;    
    }

    public function list()
    {
        if (!$this->validate()) {
            return false;
        }
        $postQuery = Post::find()
                ->limit($this->limit)
                ->offset($this->offset);
        if (empty($postQuery)) {
            $this->addError('query', 'Can`t find posts');
            return false;
        }
        //$result = [];
        foreach ($postQuery->each() as $post) {
            $this->result[] = serialize($post);
        }
        return true;
    }

}