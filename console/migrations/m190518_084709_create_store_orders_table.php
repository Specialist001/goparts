<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_orders}}`.
 */
class m190518_084709_create_store_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null(),
            'delivery_id' => $this->integer(11)->null(),
            'status_id' => $this->integer(11)->null(),
            'manager_id' => $this->integer(11)->null(),
            'delivery_price' => $this->decimal(10, 2)->defaultValue(0.00),
            'payment_method_id' => $this->integer(11)->null(),
            'paid' => $this->smallInteger(2)->null()->defaultValue(0),
            'payment_time' => $this->integer(11)->null(),
            'payment_details' => $this->text()->null(),
            'total_price' => $this->decimal(10, 2)->defaultValue(0.00),
            'discount' => $this->decimal(10, 2)->defaultValue(0.00),
            'coupon_discount' => $this->decimal(10, 2)->defaultValue(0.00),
            'separate_delivery' => $this->smallInteger(2)->defaultValue(0),

            'name' => $this->string(255),
            'street' => $this->string(255),
            'phone' => $this->string(255),
            'email' => $this->string(255),
            'comment' => $this->text(),
            'ip' => $this->string(30)->null(),
            'url' => $this->string(255)->null(),
            'note' => $this->text()->null(),
            'zipcode' => $this->string(30)->null(),
            'country' => $this->string(255)->null(),
            'city' => $this->string(255)->null(),
            'house' => $this->string(255)->null(),
            'apartment' => $this->string(255)->null(),

            'created_at' => $this->integer(11)->notNull()->comment('created date'),
            'updated_at' => $this->integer(11)->notNull()->comment('modified date'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_orders}}');
    }
}
