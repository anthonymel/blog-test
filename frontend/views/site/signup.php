<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $images ActiveQuery */
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Регистрация с запоминанием картинки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><h3>Пожалуйста, заполните следующие поля и приготовтесь запомнить картинку.</h3></p>
    <h3>Учтите, что заполнить поля и выбрать картинку нужно до истечения времени:</h3>

        <?php echo \russ666\widgets\Countdown::widget([
            'id' => 'timer',
            'datetime' => date('Y-m-d H:i:s O', time() + 200),
            'format' => '\<h3>%M:%S</h3>',
            'tagName' => 'span',
            'events' => [
                'finish' => 'function(){window.location.replace("/frontend/web/site/time-error")}',
            ],
        ]) ?>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

     
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

