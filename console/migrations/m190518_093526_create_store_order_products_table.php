<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_order_products}}`.
 */
class m190518_093526_create_store_order_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_order_products}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11)->null(),
            'product_name' => $this->string(255),
            'variants' => $this->string(255)->null(),
            'variants_text' => $this->text()->null(),
            'price' => $this->decimal(10, 2)->defaultValue(0.00),
            'quantity' => $this->integer(11)->defaultValue(0),
            'sku' => $this->string(150)->null(),
        ]);
        $this->createIndex('ix-store_order_products-order_id','{{%store_order_products}}','order_id',false);
        $this->createIndex('ix-store_order_products-product_id','{{%store_order_products}}','product_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_order_products}}');
    }
}
