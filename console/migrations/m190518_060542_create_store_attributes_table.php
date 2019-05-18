<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_attributes}}`.
 */
class m190518_060542_create_store_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attributes}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(11)->null(),
            'name' => $this->string(255),
            'type' => $this->smallInteger(4)->null(),
            'unit' => $this->string(40)->null(),
            'required' => $this->smallInteger(1)->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),
            'is_filter' => $this->smallInteger(6)->defaultValue(1),
        ]);

        $this->createIndex('ix-store_attributes-group_id','{{%store_attributes}}','group_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-store_attributes-group_id','{{%store_attributes}}');

        $this->dropTable('{{%store_attributes}}');
    }
}
