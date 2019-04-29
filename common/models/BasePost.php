<?php

namespace common\models;

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
class BasePost extends \yii\db\ActiveRecord
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
            [['date', 'text', 'title'], 'required'],
            [['date', 'category_id', 'activity', 'author_id'], 'integer'],
            [['text', 'abridgment'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['category_id'], 'default', 'value' => 1],
            [['abridgment'], 'default', 'value' => 'test']
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
