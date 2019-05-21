<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_products}}`.
 */
class m190518_105039_create_store_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_products}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(11)->null(),
            'producer_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->null(),
            'type_car_id' => $this->integer(11)->null(),
            'user_id' => $this->integer(11),
            'sku' => $this->string(150)->null(),
            'serial_number' => $this->string(150),
            'slug' => $this->string(255),
            'price' => $this->decimal(19, 3)->defaultValue(0.000),
            'discount_price' => $this->decimal(19, 3)->null(),
            'discount' => $this->decimal(19, 3)->null(),
            'data' => $this->text()->null(),
            'is_special' => $this->smallInteger(1)->defaultValue(0),
            'length' => $this->decimal(19, 3)->null(),
            'width' => $this->decimal(19, 3)->null(),
            'height' => $this->decimal(19, 3)->null(),
            'weight' => $this->decimal(19, 3)->null(),
            'quantity' => $this->integer(11)->null(),
            'in_stock' => $this->smallInteger(4)->defaultValue(1),
            'status' => $this->smallInteger(1)->defaultValue(1),

            'title' => $this->string(255)->null(),
            'image' => $this->string(255)->null(),

            'average_price' => $this->decimal(19, 3)->null(),
            'purchase_price' => $this->decimal(19, 3)->null(),
            'recommended_price' => $this->decimal(19, 3)->null(),

            'order' => $this->integer(11)->defaultValue(0),

            'external_id' => $this->string(100)->null(),
            'view' => $this->integer(11)->null()->defaultValue(0),
            'qid' => $this->integer(11)->null()->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_products}}');
    }
}
