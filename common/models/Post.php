<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
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
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','text'], 'string'],
            [['date'], 'default', 'value' => Yii::$app->formatter->asTimestamp(date('d.m.Y H:i'))],
            [['category_id'], 'default', 'value' => 1],
            [['author_id'], 'default', 'value' => Yii::$app->user->id],
            [['abridgment'], 'default', 'value' => 1],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'category_id' => 'Category ID',
            'text' => 'Text',
            'title' => 'Title',
            'abridgment' => 'Abridgment',
            'activity' => 'Activity',
            'author_id' => 'Author ID',
        ];
    }
}
