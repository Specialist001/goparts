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
    public function up()
    {
        $this->createTable('{{%store_category_attribute_values}}', [
            'id' => $this->primaryKey(),
            'store_category_id' => $this->integer(11),
            'store_attribute_id' => $this->integer(11),
            'store_option_id' => $this->integer(11)->null(),
            'number_value' => $this->double()->null(),
            'string_value' => $this->string(255)->null(),
            'text_value' => $this->text(255)->null(),

            'created_at' => $this->integer(11)->notNull(),
        ]);
        $this->createIndex('ix-store_category_attribute_values-store_category_id','{{%store_category_attribute_values}}','store_category_id',false);
        $this->createIndex('ix-store_category_attribute_values-store_attribute_id','{{%store_category_attribute_values}}','store_attribute_id',false);
        $this->createIndex('ix-store_category_attribute_values-store_option_id','{{%store_category_attribute_values}}','store_option_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {


        $this->dropTable('{{%store_category_attribute_values}}');
    }
}
