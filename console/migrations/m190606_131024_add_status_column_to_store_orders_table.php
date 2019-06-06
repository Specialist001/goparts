<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%store_orders}}`.
 */
class m190606_131024_add_status_column_to_store_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%store_orders}}', 'status', $this->smallInteger(1)->defaultValue(1)->notNull()->after('payment_method_id')->comment('1-New, 2-Accepted, 3-Completed, 4-Cancelled'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%store_orders}}', 'status');
    }
}
