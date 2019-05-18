<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_deliveries}}`.
 */
class m190518_083758_create_store_deliveries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_deliveries}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'price' => $this->float(10, 2)->defaultValue(0.00),
            'free_form' => $this->float(10, 2)->null(),
            'available_form' => $this->float(10, 2)->null(),
            'order' => $this->integer(11)->defaultValue(0),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'separate_payment' => $this->smallInteger(2)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_deliveries}}');
    }
}
