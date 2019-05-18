<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_order_coupons}}`.
 */
class m190518_093158_create_store_order_coupons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_order_coupons}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'coupon_id' => $this->integer(11),

            'created_at' => $this->integer(11)->notNull()->comment('created date'),
        ]);

        $this->createIndex('ix-store_order_coupons-order_id','{{%store_order_coupons}}','order_id',false);
        $this->createIndex('ix-store_order_coupons-coupon_id','{{%store_order_coupons}}','coupon_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_order_coupons-order_id','{{%store_order_coupons}}');
        $this->dropIndex('ix-store_order_coupons-coupon_id','{{%store_order_coupons}}');

        $this->dropTable('{{%store_order_coupons}}');
    }
}
