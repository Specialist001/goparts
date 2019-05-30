<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_cars}}`.
 */
class m190519_073211_create_store_product_to_cars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_to_cars}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null()->comment('store_products->id'),
            'car_id' => $this->integer(11)->null(),
        ]);

        $this->createIndex('ix-store_product_to_cars-product_id','{{%store_product_to_cars}}','product_id',false);
        $this->createIndex('ix-store_product_to_cars-car_id','{{%store_product_to_cars}}','car_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_product_cars}}');
    }
}
