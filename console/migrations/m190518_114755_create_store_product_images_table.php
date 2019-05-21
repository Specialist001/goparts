<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_images}}`.
 */
class m190518_114755_create_store_product_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_images}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'link' => $this->string(255),
            'title' => $this->string(255)->null(),
            'group_id' => $this->integer(11)->null()->comment('store_product_image_groups'),
        ]);
        $this->createIndex('ix-store_product_images-product_id','{{%store_product_images}}','product_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_product_images}}');
    }
}
