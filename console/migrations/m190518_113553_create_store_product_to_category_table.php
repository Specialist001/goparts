<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_to_category}}`.
 */
class m190518_113553_create_store_product_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_to_category}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->null(),
        ]);


    }

    public function safeUp()
    {
        $this->createIndex('ix-store_product_to_category-product_id','{{%store_product_to_category}}','product_id',false);
        $this->createIndex('ix-store_product_to_category-category_id','{{%store_product_to_category}}','category_id',false);    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_product_to_category-product_id','{{%store_product_to_category}}');
        $this->dropIndex('ix-store_product_to_category-category_id','{{%store_product_to_category}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_product_to_category}}');
    }
}
