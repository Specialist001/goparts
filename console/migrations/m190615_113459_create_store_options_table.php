<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_options}}`.
 */
class m190615_113459_create_store_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_options}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_options}}');
    }
}
