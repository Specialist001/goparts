<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_order_status}}`.
 */
class m190518_094059_create_store_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_order_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'is_system' => $this->smallInteger(1)->defaultValue(0),
            'color' => $this->string(255)->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_order_status}}');
    }
}
