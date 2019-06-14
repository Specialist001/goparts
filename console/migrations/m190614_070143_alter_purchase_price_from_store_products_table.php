<?php

use yii\db\Migration;

/**
 * Class m190614_070143_alter_purchase_price_from_store_products_table
 */
class m190614_070143_alter_purchase_price_from_store_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('{{%store_products}}', 'purchase_price', $this->double(2)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190614_070143_alter_purchase_price_from_store_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_070143_alter_purchase_price_from_store_products_table cannot be reverted.\n";

        return false;
    }
    */
}
