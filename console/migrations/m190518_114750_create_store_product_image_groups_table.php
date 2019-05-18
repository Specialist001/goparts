<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_image_groups}}`.
 */
class m190518_114750_create_store_product_image_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_image_groups}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product_image_groups}}');
    }
}
