<?php

use yii\db\Migration;

/**
 * Handles adding vat to table `{{%store_products}}`.
 */
class m190608_060331_add_vat_column_to_store_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%store_products}}', 'vat', $this->integer(11)->defaultValue(0)->null()->after('discount_price'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
    }
}
