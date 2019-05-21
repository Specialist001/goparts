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
    public function up()
    {
        $this->createTable('{{%store_attributes}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(11)->null(),
            'name' => $this->string(255),
            'type' => $this->smallInteger(2)->null(),
            'unit' => $this->string(40)->null(),
            'required' => $this->smallInteger(1)->defaultValue(0)->comment('0-no required, 1-required'),
            'order' => $this->integer(11)->defaultValue(0),
            'is_filter' => $this->smallInteger(6)->defaultValue(1),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-store_attributes-group_id','{{%store_attributes}}','group_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_attributes-group_id','{{%store_attributes}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_attributes}}');
    }
}
