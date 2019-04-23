<?php

namespace frontend\controllers;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\Pagination;
use common\models\Post;
use common\models\User;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'update', 'delete', 'view', 'list', 'myposts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

  	public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $this->view->title = 'Posts List';
        return $this->render('_show_item', ['listDataProvider' => $dataProvider]);
    }

    public function actionShow()
    {
    	$id = \Yii::$app->request->get('id');
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['id' => $id]),
        ]);
        $this->view->title = 'View post';
        return $this->render('_show_item', ['listDataProvider' => $dataProvider]);
    }

    public function actionMyposts()
    {
    	$dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['author_id' => \Yii::$app->user->identity->id]),
             'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $this->view->title = 'View post';
        return $this->render('_show_item', ['listDataProvider' => $dataProvider]);
    }

        public function actionCreate()
    {
        $model = new Post();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['show', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
