<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Class m200223_081933_addImageAuthTable
 */
class m200223_081933_addImageAuthTable extends Migration
{
    public function safeUp()
    {
        $this->createTable('authImage', [
            'authImageId' => Schema::TYPE_PK,
            'imageUrl' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('authImage');
    }
}
