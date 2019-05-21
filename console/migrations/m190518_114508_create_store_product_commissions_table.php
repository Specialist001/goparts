<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_commissions}}`.
 */
class m190518_114508_create_store_product_commissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_commissions}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null(),
            'comission' => $this->integer(11)->null()
        ]);

        $this->createIndex('ix-store_product_commissions-product_id','{{%store_product_commissions}}','product_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_product_commissions}}');
    }
}
