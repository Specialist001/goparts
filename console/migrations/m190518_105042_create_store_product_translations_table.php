<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_translations}}`.
 */
class m190518_105042_create_store_product_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_translations}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'locale' => $this->string(255),
            'name' => $this->string(255),
            'short' => $this->string(255)->null(),
            'description' => $this->text()->null(),

            'meta_title' => $this->string(255)->null(),
            'meta_description' => $this->string(255)->null(),
            'meta_keywords' => $this->text()->null(),
            'meta_canonical' => $this->string(255)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product_translations}}');
    }
}
