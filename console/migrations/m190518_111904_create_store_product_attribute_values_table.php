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
    public function up()
    {
        $this->createTable('{{%store_product_attribute_values}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'attribute_id' => $this->integer(11),
            'option_id' => $this->integer(11)->null(),
            'number_value' => $this->double()->null(),
            'string_value' => $this->string(255)->null(),
            'text_value' => $this->text()->null(),

            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-store_product_attribute_values-product_id','{{%store_product_attribute_values}}','product_id', false);
        $this->createIndex('ix-store_product_attribute_values-attribute_id','{{%store_product_attribute_values}}','attribute_id', false);
        $this->createIndex('ix-store_product_attribute_values-option_id','{{%store_product_attribute_values}}','option_id', false);    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_product_attribute_values-product_id','{{%store_product_attribute_values}}');
        $this->dropIndex('ix-store_product_attribute_values-attribute_id','{{%store_product_attribute_values}}');
        $this->dropIndex('ix-store_product_attribute_values-option_id','{{%store_product_attribute_values}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_product_attribute_values}}');
    }
}
