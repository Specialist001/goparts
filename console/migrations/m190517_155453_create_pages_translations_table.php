<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages_translations}}`.
 */
class m190517_155453_create_pages_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages_translations}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(11),
            'lang' => $this->char(2)->null(),
            'title' => $this->string(255),
            'title_short' => $this->string(255)->null(),
            'body' => $this->text(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-pages_translations-page_id', '{{%pages_translations}}', 'page_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages_translations}}');
    }
}
