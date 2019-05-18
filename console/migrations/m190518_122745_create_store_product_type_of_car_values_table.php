<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_type_of_car_values}}`.
 */
class m190518_122745_create_store_product_type_of_car_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_type_of_car_values}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null()->comment('store_products->id'),
            'type_car_id' => $this->integer(11)->null()->comment('store_type_of_car->id'),

            'created_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-store_product_type_of_car_values-product_id','{{%store_product_type_of_car_values}}','product_id', false);
        $this->createIndex('ix-store_product_type_of_car_values-type_car_id','{{%store_product_type_of_car_values}}','type_car_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_product_type_of_car_values-product_id','{{%store_product_type_of_car_values}}');
        $this->dropIndex('ix-store_product_type_of_car_values-type_car_id','{{%store_product_type_of_car_values}}');

        $this->dropTable('{{%store_product_type_of_car_values}}');
    }
}
