<?php

namespace frontend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;
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

    public $postQuery;

    public function rules()
    {
        return [
            [['limit'], 'default', 'value' => 10],
            [['offset'], 'default', 'value' => 0],
            ['token', 'string', 'min' => 10]
        ];
    }

 
    public function getMyPostsQuery()
    {
        if (!$this->validate()) {
            return false;
        }

        //TODO: $user = \Yii::$app->user->getIdentity();
        //TODO: remove
        $tokenInfo = Token::find()->andwhere(['token.token' => $this->token])->one();
        if (empty($tokenInfo)) {
            $this->addError('token', 'Wrong token');
            return false;
        }
        $this->postQuery = Post::find()
            ->andwhere(['post.author_id' => $tokenInfo->user_id])
            ->limit($this->limit)
            ->offset($this->offset);
        return true;
    }


    public function getAllPostQuery()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->postQuery = Post::find()
                ->limit($this->limit)
                ->offset($this->offset);
        return true;
    }

    public function formatQueryAsArray($query)
    {
        $result = [];
        $number = 0;
        foreach ($query->each() as $post) {
            $result[$number] = [
                'id' => $post->id,
                'text' => $post->text,
                'title' => $post->title,
                'date' => $post->date,
            ];
        $number++;
        }
        return $result;
    }

}