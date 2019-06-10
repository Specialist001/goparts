<?php

use yii\db\Migration;

/**
 * Class m190609_143129_add_stocks
 */
class m190609_143129_add_stocks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $stock = new \common\models\Stock();
        $stock->city_id = 1;
        $stock->name = 'First Stock';
        $stock->description = '';
        $stock->location = '25.318522, 55.408817';
        $stock->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190609_143129_add_stocks cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190609_143129_add_stocks cannot be reverted.\n";

        return false;
    }
    */
}
