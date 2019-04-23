<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m190420_063049_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'token_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string(32)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%token}}');
    }
}
