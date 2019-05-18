<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_attribute_values}}`.
 */
class m190518_111904_create_store_product_attribute_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_attribute_values}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'attribute_id' => $this->integer(11),

            'number_value' => $this->double()->null(),
            'string_value' => $this->string(255)->null(),
            'text_value' => $this->text()->null(),
            'option_value' => $this->integer(11)->null(),

            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product_attribute_values}}');
    }
}
