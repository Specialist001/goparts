<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_translations}}`.
 */
class m190517_153449_create_news_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_translations}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer(11),
            'lang' => $this->char(2),
            'title' => $this->string(255),
            'slug' => $this->string(255),
            'short_text' => $this->text()->null(),
            'full_text' => $this->text(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_translations}}');
    }
}
