<?php

use yii\db\Migration;

/**
 * Class m190718_094201_add_message
 */
class m190718_094201_add_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'backend';
        $source_message->message = 'Owner name';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Owner';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'Owner';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Owner';
        $mes->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190718_094201_add_message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190718_094201_add_message cannot be reverted.\n";

        return false;
    }
    */
}
