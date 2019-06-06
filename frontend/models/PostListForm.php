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

    public function prepareMyPostsQuery()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = \Yii::$app->user->getIdentity();
        if (empty($user)) {
            $this->addError('token', 'Wrong token');
            return false;
        }
        $this->postQuery = Post::find()
            ->andwhere(['post.author_id' => $user->id])
            ->limit($this->limit)
            ->offset($this->offset);
        return true;
    }


    public function prepareAllPostQuery()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->postQuery = Post::find()
                ->limit($this->limit)
                ->offset($this->offset);
        return true;
    }
}