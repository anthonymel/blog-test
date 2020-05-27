<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "authimage".
 *
 * @property int $authImageId
 * @property string $imageUrl
 * @property string $description
 */
class Authimage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageUrl'], 'required'],
            [['description'], 'string'],
            [['imageUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authImageId' => 'Auth Image ID',
            'imageUrl' => 'Image Url',
            'description' => 'Description',
        ];
    }
}
