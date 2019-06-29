<?php

use yii\db\Migration;

/**
 * Class m190629_104155_alter_table_columns
 */
class m190629_104155_alter_table_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('{{%user}}', 'type', $this->smallInteger(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190629_104155_alter_table_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190629_104155_alter_table_columns cannot be reverted.\n";

        return false;
    }
    */
}
