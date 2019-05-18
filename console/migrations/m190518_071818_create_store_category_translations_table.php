<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_category_translations}}`.
 */
class m190518_071818_create_store_category_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_category_translations}}', [
            'id' => $this->primaryKey(),
            'store_category_id' => $this->integer(11),
            'locale' => $this->string(255),
            'title' => $this->string(255),
            'short' => $this->text()->null(),
            'description' => $this->text()->null(),

            'meta_title' => $this->string(255)->null(),
            'meta_description' => $this->string(255)->null(),
            'meta_keywords' => $this->text()->null(),
        ]);

        $this->createIndex('ix-store_category_translations-store_category_id','{{%store_category_translations}}','store_category_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_category_translations-store_category_id','{{%store_category_translations}}');

        $this->dropTable('{{%store_category_translations}}');
    }
}
