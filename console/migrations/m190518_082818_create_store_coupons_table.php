<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_coupons}}`.
 */
class m190518_082818_create_store_coupons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_coupons}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(255),
            'type' => $this->smallInteger(2)->defaultValue(0),
            'value' => $this->decimal(10,2)->defaultValue(0.00),
            'min_order_price' => $this->decimal(10,2)->defaultValue(0.00),
            'registered_user' => $this->smallInteger(4)->defaultValue(0),
            'free_shipping' => $this->smallInteger(4)->defaultValue(0),

            'start_time' => $this->integer(11)->null(),
            'end_time' => $this->integer(11)->null(),

            'quantity' => $this->integer(11)->null(),
            'quantity_per_user' => $this->integer(11)->null(),

            'status' => $this->smallInteger(1)->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_coupons}}');
    }
}
