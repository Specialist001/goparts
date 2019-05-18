<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_group_translations}}`.
 */
class m190518_061052_create_store_attribute_group_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attribute_group_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_group_id' => $this->integer(11),
            'locale' => $this->string(255),
            'name' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-store_attribute_group_translations-attribute_group_id',
            '{{%store_attribute_group_translations}}','attribute_group_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_attribute_group_translations-attribute_group_id',
            '{{%store_attribute_group_translations}}');

        $this->dropTable('{{%store_attribute_group_translations}}');
    }
}
