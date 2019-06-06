<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%store_order_status}}`.
 */
class m190606_125935_drop_store_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%store_order_status}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->createTable('{{%store_order_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'is_system' => $this->smallInteger(1)->defaultValue(0),
            'color' => $this->string(255)->null()
        ]);
    }
}
