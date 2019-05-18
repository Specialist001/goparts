<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_attribute_groups}}`.
 */
class m190518_061003_create_store_attribute_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attribute_groups}}', [
            'id' => $this->primaryKey(),
            'order' => $this->integer(11)->defaultValue(1),
            'name' => $this->string(255)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_attribute_groups}}');
    }
}
