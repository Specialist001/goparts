<?php

use yii\db\Migration;

/**
 * Class m190523_141433_add_languages
 */
class m190523_141433_add_languages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $english = new \common\models\Language();
        $english->url = 'en';
        $english->locale = 'en-EN';
        $english->name = 'English';
        $english->default = 1;
        $english->save();

        $arabic = new \common\models\Language();
        $arabic->url = 'ar';
        $arabic->locale = 'ar-AE';
        $arabic->name = 'عربى';
        $arabic->default = 0;
        $arabic->save();

        $russian = new \common\models\Language();
        $russian->url = 'ru';
        $russian->locale = 'ru-RU';
        $russian->name = 'Русский';
        $russian->default = 0;
        $russian->save();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190523_141433_add_languages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190523_141433_add_languages cannot be reverted.\n";

        return false;
    }
    */
}
