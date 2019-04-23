<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
?>

<article class="item" data-key="<?= $model->id; ?>">
    <h2 class="title">
   		 <?= Html::a(Html::encode($model->title), Url::toRoute(['show', 'id' => $model->id]), ['title' => $model->title]) ?>
    </h2>
  	<h3 class="text">
   		 <?= $model->text; ?>
    </h3>
    <div class="item-excerpt">
    Date: <?= Html::encode(Yii::$app->formatter->asDatetime($model->date, 'php:d.m.Y H:i')); ?> Author: <?= User::findOne($model->author_id)->username;?>
    </div>
</article>