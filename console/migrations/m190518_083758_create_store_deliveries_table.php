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
    public function up()
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
            'separate_payment' => $this->smallInteger(2)->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'deleted_at' => $this->integer(11)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_deliveries}}');
    }
}
