<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%languages}}`.
 */
class m190523_140710_create_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(100)->notNull(),
            'locale' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'default' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'order' => $this->integer(11)->notNull()->defaultValue('0'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('UNIQUE', '{{%languages}}', 'locale', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }
}
