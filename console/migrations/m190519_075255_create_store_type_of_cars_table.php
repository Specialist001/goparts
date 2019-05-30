<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_type_of_cars}}`.
 */
class m190519_075255_create_store_type_of_cars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_type_of_cars}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->null(),
            'external_id' => $this->string(100)->null(),
            'slug' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),
            'view' => $this->string(100)->null(),
            'image' => $this->string(255)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_type_of_cars}}');
    }
}
