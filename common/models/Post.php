<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use yii\rest\Serializer;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $date
 * @property int $category_id
 * @property string $text
 * @property string $title
 * @property string $abridgment
 * @property int $activity
 * @property int $author_id
 */
class Post extends BasePost
{
   
}
