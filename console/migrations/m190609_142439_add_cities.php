<?php

use yii\db\Migration;

/**
 * Class m190609_142439_add_cities
 */
class m190609_142439_add_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $city = new \common\models\City();
        $city->name = 'Dubai';
        $city->location = '25.207012, 55.271111';
        $city->status = 1;
        $city->save();

        $city = new \common\models\City();
        $city->name = 'Abu-Dhabi';
        $city->location = '24.453639, 54.375422';
        $city->status = 1;
        $city->save();

        $city = new \common\models\City();
        $city->name = 'Sharjah';
        $city->location = '25.342869, 55.422029';
        $city->status = 1;
        $city->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190609_142439_add_cities cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190609_142439_add_cities cannot be reverted.\n";

        return false;
    }
    */
}
