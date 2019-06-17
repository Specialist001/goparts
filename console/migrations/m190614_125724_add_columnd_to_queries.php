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
    public function up()
    {
        $this->addColumn('{{%queries}}','phone',$this->string(255)->after('name'));
        $this->addColumn('{{%queries}}','email',$this->string(255)->notNull()->after('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
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
