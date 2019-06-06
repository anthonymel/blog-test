<?php

use yii\db\Migration;

/**
 * Class m190602_180227_add_foreign_key_user_to_token
 */
class m190602_180227_add_foreign_key_user_to_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		     $this->addForeignKey(
             'fk-token-user-1',
             'token',
             'user_id',
             'user',
             'id',
             'CASCADE',
             'CASCADE'
         );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190602_180227_add_foreign_key_user_to_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190602_180227_add_foreign_key_user_to_token cannot be reverted.\n";

        return false;
    }
    */
}
