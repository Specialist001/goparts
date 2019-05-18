<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_attributes}}`.
 */
class m190518_111838_create_store_product_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_attributes}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null()->comment('store_product'),
            'type_id' => $this->integer(11)->null()->comment('store_type'),
        ]);

        $this->createIndex('ix-store_product_attributes-product_id','{{%store_product_attributes}}','product_id',false);
        $this->createIndex('ix-store_product_attributes-type_id','{{%store_product_attributes}}','type_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_product_attributes-product_id','{{%store_product_attributes}}');
        $this->dropIndex('ix-store_product_attributes-type_id','{{%store_product_attributes}}');

        $this->dropTable('{{%store_product_attributes}}');
    }
}
