<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_category_attributes}}`.
 */
class m190518_071848_create_store_category_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_category_attributes}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->null(),
            'type_id' => $this->integer(11)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_category_attributes}}');
    }
}
