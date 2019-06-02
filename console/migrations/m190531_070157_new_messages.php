<?php

use yii\db\Migration;

/**
 * Class m190531_070157_new_messages
 */
class m190531_070157_new_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'backend';
        $source_message->message = 'Store Category';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Store Category';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'متجر الفئة';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Категории магазина';
        $mes->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190531_070157_new_messages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190531_070157_new_messages cannot be reverted.\n";

        return false;
    }
    */
}
