<?php

use yii\db\Migration;

/**
 * Class m190714_125750_add_new_mesages
 */
class m190714_125750_add_new_mesages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'The Largest Online Store';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'The Largest Online Store';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'The Largest Online Store';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan Short';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'for Used Spare Parts in U.A.E.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'for Used Spare Parts in U.A.E.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'for Used Spare Parts in U.A.E.';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan Text';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Daily users. Get more offers and opportunities by registering to our webpage.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'Daily users. Get more offers and opportunities by registering to our webpage.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Daily users. Get more offers and opportunities by registering to our webpage.';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'Start working with us and';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'Start working with us and';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'Start working with us and';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2 short';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'build your profitable business';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'build your profitable business';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'build your profitable business';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2 text';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = 'UAEPARTS is the largest online store in UAE, that offers its customers the widest range of spare auto parts and accessories. With us you will have an option to purchase a product online and pay using our secure online payment system or you can pay upon receiving the product. We also offer an express delivery to any address throughout UAE, so the product is delivered to you as soon as possible.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = 'UAEPARTS is the largest online store in UAE, that offers its customers the widest range of spare auto parts and accessories. With us you will have an option to purchase a product online and pay using our secure online payment system or you can pay upon receiving the product. We also offer an express delivery to any address throughout UAE, so the product is delivered to you as soon as possible.';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = 'UAEPARTS is the largest online store in UAE, that offers its customers the widest range of spare auto parts and accessories. With us you will have an option to purchase a product online and pay using our secure online payment system or you can pay upon receiving the product. We also offer an express delivery to any address throughout UAE, so the product is delivered to you as soon as possible.';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2 child_1';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = '<p>Widest range of auto spare parts</p><p>Detailed information about the product</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = '<p>Widest range of auto spare parts</p><p>Detailed information about the product</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = '<p>Widest range of auto spare parts</p><p>Detailed information about the product</p>';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2 child_2';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = '<p>Leave us an order and get prices from more than 1000s of shops.</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = '<p>Leave us an order and get prices from more than 1000s of shops.</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = '<p>Leave us an order and get prices from more than 1000s of shops.</p>';
        $mes->save();


        $source_message = new \common\models\SourceMessage();
        $source_message->category = 'frontend';
        $source_message->message = 'Slogan_2 child_3';
        $source_message->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'en-EN';
        $mes->translation = '<p>Convenient multiple payment options</p><p>Express delivery</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ar-AE';
        $mes->translation = '<p>Convenient multiple payment options</p><p>Express delivery</p>';
        $mes->save();

        $mes = new \common\models\Message();
        $mes->id = $source_message->id;
        $mes->language = 'ru-RU';
        $mes->translation = '<p>Convenient multiple payment options</p><p>Express delivery</p>';
        $mes->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190714_125750_add_new_mesages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190714_125750_add_new_mesages cannot be reverted.\n";

        return false;
    }
    */
}
