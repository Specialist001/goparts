<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_payments}}`.
 */
class m190518_094229_create_store_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_payments}}', [
            'id' => $this->primaryKey(),
            'module' => $this->string(150),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'settings' => $this->text()->null(),
            'currency_id' => $this->integer(11)->null(),
            'order' => $this->integer(11)->defaultValue(1),
            'status' => $this->smallInteger(1)->defaultValue(0),

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
        $this->dropTable('{{%store_payments}}');
    }
}
