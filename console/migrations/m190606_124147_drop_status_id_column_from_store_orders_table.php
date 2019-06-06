<?php

use yii\db\Migration;

/**
 * Handles dropping status_id from table `{{%store_orders}}`.
 */
class m190606_124147_drop_status_id_column_from_store_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropForeignKey('fk-store_orders-status_id', '{{%store_orders}}');

        $this->dropColumn('{{%store_orders}}', 'status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
