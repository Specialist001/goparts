<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_delivery_payments}}`.
 */
class m190518_084258_create_store_delivery_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_delivery_payments}}', [
            'id' => $this->primaryKey(),
            'delivery_id' => $this->integer(11),
            'payment_id' => $this->integer(11),
        ]);
        $this->createIndex('ix-store_delivery_payments-delivery_id','{{%store_delivery_payments}}','delivery_id',false);
        $this->createIndex('ix-store_delivery_payments-payment_id','{{%store_delivery_payments}}','payment_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_delivery_payments}}');
    }
}
