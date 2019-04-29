<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\User;
use common\models\Token;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\Serializer;

class PostApiController extends Controller
{
	public function actionMyPosts()
	{
		$token = \Yii::$app->request->get('access-token');
		$limit = \Yii::$app->request->get('limit');
		$offset = \Yii::$app->request->get('offset');
		if (empty($limit)) $limit = 10;
		if (empty($offset)) $offset = 0;
		$tokenInfo = Token::find()->where(['token' => $token])->one();
		if (!empty($tokenInfo)){
			$postQuery = Post::find()
				->select(['title', 'text', 'date', 'author_id'])
				->where(['author_id' => $tokenInfo->user_id])
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
		return json_encode($result);
		exit();
	}

	public function actionList()
	{
		$limit = \Yii::$app->request->get('limit');
		$offset = \Yii::$app->request->get('offset');
		if (empty($limit)) $limit = 10;
		if (empty($offset)) $offset = 0;
		$postQuery = Post::find()
				->select(['title', 'text', 'date', 'author_id'])
				->limit($limit)
				->offset($offset);
		$result = [];
		foreach ($postQuery->each() as $post) {
			//$post = new Serializer;
			$result[] = serialize($post);
		}
		return json_encode($result);
	}

	public function actionCreatePost()
	{
		$token = \Yii::$app->request->get('access-token');
		$text = \Yii::$app->request->get('text');
		$title = \Yii::$app->request->get('title');
		$result = null;
		$tokenInfo = Token::find()->where(['token' => $token])->one();
		if (empty($tokenInfo) || empty($text) || empty($title)){
			$result['errorInfo'] = "wrong_data";
			return json_encode($result);
		} else {
			$post = new Post();
			$post->text = $text;
			$post->title = $title;
			$post->author_id = $tokenInfo->user_id;
			$post->date = \Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
			$post->save();
			$result['Info'] = "success";
			return json_encode($result);
		}



	}

}