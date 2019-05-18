<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_translations}}`.
 */
class m190517122640_create_blog_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_translations}}', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer(11),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'locale' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-blog_translations-blog_id','{{%blog_translations}}','blog_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-blog_translations-blog_id','{{%blog_translations}}');

        $this->dropTable('{{%blog_translations}}');
    }
}
