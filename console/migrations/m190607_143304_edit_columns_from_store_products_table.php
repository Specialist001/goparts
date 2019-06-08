<?php

use yii\db\Migration;

/**
 * Class m190607_143304_edit_columns_from_store_products_table
 */
class m190607_143304_edit_columns_from_store_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('{{%store_products}}', 'price', $this->integer()->null());
        $this->alterColumn('{{%store_products}}', 'discount_price', $this->integer()->null());
        $this->alterColumn('{{%store_products}}', 'discount', $this->integer()->null());
        $this->alterColumn('{{%store_products}}', 'average_price', $this->integer()->null());
        $this->alterColumn('{{%store_products}}', 'purchase_price', $this->integer()->null());
        $this->alterColumn('{{%store_products}}', 'recommended_price', $this->integer()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190607_143304_edit_columns_from_store_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190607_143304_edit_columns_from_store_products_table cannot be reverted.\n";

        return false;
    }
    */
}
