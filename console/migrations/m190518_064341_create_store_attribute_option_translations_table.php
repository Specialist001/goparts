<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_option_translations}}`.
 */
class m190518_064341_create_store_attribute_option_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_attribute_option_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_option_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en'),
            'value' => $this->string(255)
        ]);
        $this->createIndex('ix-store_attribute_option_translations-attribute_option_id','{{%store_attribute_option_translations}}','attribute_option_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_attribute_option_translations}}');
    }
}
