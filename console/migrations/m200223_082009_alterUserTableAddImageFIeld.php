<?php

use yii\db\Migration;

/**
 * Class m200223_082009_alterUserTableAddImageFIeld
 */
class m200223_082009_alterUserTableAddImageFIeld extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'authImageUrl', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'authImageUrl');
    }
}