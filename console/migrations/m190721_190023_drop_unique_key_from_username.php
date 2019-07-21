<?php

use yii\db\Migration;

/**
 * Class m190721_190023_drop_unique_key_from_username
 */
class m190721_190023_drop_unique_key_from_username extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('un-user_username', '{{%user}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190721_190023_drop_unique_key_from_username cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190721_190023_drop_unique_key_from_username cannot be reverted.\n";

        return false;
    }
    */
}
