<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_orders_to__coupons}}`.
 */
class m190518_093158_create_store_orders_to_coupon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_orders_to_coupon}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'coupon_id' => $this->integer(11),

            'created_at' => $this->integer(11)->notNull()->comment('created date'),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-store_orders_to_coupon-order_id','{{%store_orders_to_coupon}}','order_id',false);
        $this->createIndex('ix-store_orders_to_coupon-coupon_id','{{%store_orders_to_coupon}}','coupon_id',false);    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_orders_to_coupon-order_id','{{%store_orders_to_coupon}}');
        $this->dropIndex('ix-store_orders_to_coupon-coupon_id','{{%store_orders_to_coupon}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_orders_to_coupon}}');
    }
}
