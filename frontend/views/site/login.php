<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход по картинке';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
                        <?php echo \russ666\widgets\Countdown::widget([
                            'id' => 'timer',
                            'datetime' => date('Y-m-d H:i:s O', time() + 200),
                            'format' => '\<h3>%M:%S</h3>',
                            'tagName' => 'span',
                            'events' => [
                                'finish' => 'function(){window.location.replace("/frontend/web/site/time-error")}',
                            ],
                        ]) ?>
    <p>Если подходящей картинки нет в списке, перезагрузите страницу:</p>

    <p>Заполните поля:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->label('Имя пользователя')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->label('Запоминть меня')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    Забыли пароль? <?= Html::a(' восстановить', ['site/request-password-reset']) ?>.
                    <br>
                </div>


                <?php Modal::begin([
                 'header' => '<h2>Выберите картинку:</h2>',
                 'toggleButton' => ['class' => 'btn btn-primary btn-lg btn-block', 'label' => 'Выбор картинки'],
                ]); ?>


                    <div class="form-group">
                        <?php
                        foreach ($images->each() as $image) {
                            echo Html::submitButton(Html::img($image->imageUrl, ['alt'=>'','height'=>'200px']), [ 'name' => 'authImageUrl', 'value' => $image->imageUrl]);
                            }
                        ?>
                    </div>

                <?php Modal::end(); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
