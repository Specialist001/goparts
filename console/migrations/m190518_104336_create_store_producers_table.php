<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_producers}}`.
 */
class m190518_104336_create_store_producers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_producers}}', [
            'id' => $this->primaryKey(),
            'name_short' => $this->string(150),
            'name' => $this->string(255),
            'slug' => $this->string(255),
            'image' => $this->string(255)->null(),
            'short_description' => $this->string(255)->null(),
            'description' => $this->text()->null(),

            'meta_title' => $this->string(255)->null(),
            'meta_description' => $this->string(255)->null(),
            'meta_keywords' => $this->text()->null(),

            'order' => $this->integer(11)->defaultValue(0),
            'status' => $this->smallInteger(11)->defaultValue(0),
            'view' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_producers}}');
    }
}
