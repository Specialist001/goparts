<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_variants}}`.
 */
class m190519_063801_create_store_product_variants_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_variants}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'attribute_id' => $this->integer(11),
            'attribute_value' => $this->string(255)->null(),
            'amount' => $this->float()->null(),
            'type' => $this->smallInteger(2)->null(),
            'sku' => $this->string(150)->null(),
            'order' => $this->integer(11)->defaultValue(0),
        ]);
        $this->createIndex('ix-store_product_variants-product_id','{{%store_product_variants}}','product_id',false);
        $this->createIndex('ix-store_product_variants-attribute_id','{{%store_product_variants}}','attribute_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_product_variants}}');
    }
}
