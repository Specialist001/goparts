<?php

use yii\db\Migration;

/**
 * Class m190718_140134_add_new_message
 */
class m190718_140134_add_new_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Query description';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Please write one part in one discription box. To add another part press add another part below';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'Please write one part in one discription box. To add another part press add another part below';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Please write one part in one discription box. To add another part press add another part below';
        $mes->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190718_140134_add_new_message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190718_140134_add_new_message cannot be reverted.\n";

        return false;
    }
    */
}
