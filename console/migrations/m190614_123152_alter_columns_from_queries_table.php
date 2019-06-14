<?php

use yii\db\Migration;

/**
 * Class m190614_123152_alter_columns_from_queries_table
 */
class m190614_123152_alter_columns_from_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('{{%queries}}','own','user_id');
        $this->addColumn('{{%queries}}','car_id',$this->integer(11)->null()->after('user_id'));
        $this->addColumn('{{%queries}}','category_id',$this->integer(11)->after('car_id'));
        $this->alterColumn('{{%queries}}', 'status', $this->smallInteger(2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190614_123152_alter_columns_from_queries_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_123152_alter_columns_from_queries_table cannot be reverted.\n";

        return false;
    }
    */
}
