<?php

use yii\db\Migration;

/**
 * Class m190614_125724_add_columnd_to_queries
 */
class m190614_125724_add_columnd_to_queries extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%queries}}','name',$this->string(150)->notNull());
        $this->addColumn('{{%queries}}','phone',$this->string(255));
        $this->addColumn('{{%queries}}','email',$this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190614_125724_add_columnd_to_queries cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_125724_add_columnd_to_queries cannot be reverted.\n";

        return false;
    }
    */
}
