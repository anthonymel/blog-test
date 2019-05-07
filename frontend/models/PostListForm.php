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

    public function rules()
    {
        return [
            [['limit'], 'default', 'value' => 10],
            [['offset'], 'default', 'value' => 0]
        ];
    }

    public function myPosts()
    {
        /*$token = \Yii::$app->request->get('access-token');
        $limit = \Yii::$app->request->get('limit');
        $offset = \Yii::$app->request->get('offset');*/
        $tokenInfo = Token::find()->andwhere(['token.token' => $this->token])->one();
        if (!empty($tokenInfo)){
            $postQuery = Post::find()
                ->andwhere(['post.author_id' => $tokenInfo->user_id])
                ->limit($limit)
                ->offset($offset);
            $result = [];
            foreach ($postQuery->each() as $post) {
                //$post = new Serializer;
                $result[] = serialize($post);
            }
        } else {
            $result = "wrong_token";
        }
        echo json_encode($result);
        exit;
    }

    public function list()
    {
        /*$limit = \Yii::$app->request->get('limit');
        $offset = \Yii::$app->request->get('offset');*/
        $postQuery = Post::find()
                ->limit($this->limit)
                ->offset($this->offset);
        $result = [];
        foreach ($postQuery->each() as $post) {
            $result[] = serialize($post);
        }
        echo json_encode($result);
        exit;
    }

}