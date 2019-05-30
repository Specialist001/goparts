<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_videos}}`.
 */
class m190519_071545_create_store_product_videos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_videos}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->null()->comment('store_products->id'),
            'video' => $this->string(255)->null(),
            'url' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-store_product_videos-product_id','{{%store_product_videos}}','product_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_product_videos}}');
    }
}
