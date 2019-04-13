<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use frontend\models\Users;
$this->title = 'My Blog';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php foreach($models as $article):?>
				<div class="jumbotron">
					<h1><?= $article->title?></h1>
					<p class="lead text-left"><?= $article->text;?></p>
					<p class="lead text-right"> By <?= Users::findOne($article->author_id)->username;?>, date: <?= $article->date;?></p>
					
				</div>
                <?php endforeach; ?>
<?php
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>
    </div>
</div>



