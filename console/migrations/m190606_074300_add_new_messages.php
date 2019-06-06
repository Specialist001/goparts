<?php

use yii\db\Migration;

/**
 * Class m190606_074300_add_new_messages
 */
class m190606_074300_add_new_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'common';
        $source_message->message = 'Username';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Username';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'اسم المستخدم';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Имя пользователямагазина';
        $mes->save();

        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'common';
        $source_message->message = 'New password';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'New password';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'كلمة السر الجديدة';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Новый пароль';
        $mes->save();

        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'common';
        $source_message->message = 'New password confirm';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'New password';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'تأكيد كلمة المرور الجديدة';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Подтверждение нового пароля';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'common';
        $source_message->message = 'Phone';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Phone';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'هاتف';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Телефон';
        $mes->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190606_074300_add_new_messages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190606_074300_add_new_messages cannot be reverted.\n";

        return false;
    }
    */
}
