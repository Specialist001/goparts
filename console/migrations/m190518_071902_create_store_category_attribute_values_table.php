<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_category_attribute_values}}`.
 */
class m190518_071902_create_store_category_attribute_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_category_attribute_values}}', [
            'id' => $this->primaryKey(),
            'store_category_id' => $this->integer(11),
            'store_attribute_id' => $this->integer(11),
            'number_value' => $this->double()->null(),
            'string_value' => $this->string(255)->null(),
            'text_value' => $this->text(255)->null(),
            'option_value' => $this->integer(11)->null(),

            'created_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-store_category_attribute_values-store_category_id','{{%store_category_attribute_values}}','store_category_id',false);
        $this->createIndex('ix-store_category_attribute_values-store_attribute_id','{{%store_category_attribute_values}}','store_attribute_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_category_attribute_values-store_category_id','{{%store_category_attribute_values}}');
        $this->dropIndex('ix-store_category_attribute_values-store_attribute_id','{{%store_category_attribute_values}}');

        $this->dropTable('{{%store_category_attribute_values}}');
    }
}
