<?php

use yii\db\Migration;

/**
 * Class m190615_105626_add_column_to_queries_table
 */
class m190615_105626_add_column_to_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%queries}}','title', $this->string(150)->notNull()->after('drivetype'));
        $this->addColumn('{{%queries}}','description',$this->string(255)->null()->after('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190615_105626_add_column_to_queries_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190615_105626_add_column_to_queries_table cannot be reverted.\n";

        return false;
    }
    */
}
