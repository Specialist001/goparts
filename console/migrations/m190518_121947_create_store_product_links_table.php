<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_links}}`.
 */
class m190518_121947_create_store_product_links_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_links}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(11)->null()->comment('store_product_link_type->id'),
            'product_id' => $this->integer(11)->comment('store_products->id'),
            'linked_product_id' => $this->integer(11)->comment('store_products->id'),
            'order' => $this->integer(),
        ]);
        $this->createIndex('ix-store_product_links-type_id','{{%store_product_links}}','type_id', false);
        $this->createIndex('ix-store_product_links-product_id','{{%store_product_links}}','product_id', false);
        $this->createIndex('ix-store_product_links-linked_product_id','{{%store_product_links}}','linked_product_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_product_links}}');
    }
}
