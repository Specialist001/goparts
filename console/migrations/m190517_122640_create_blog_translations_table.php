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
    public function up()
    {
        $this->createTable('{{%blog_translations}}', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer(11),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'locale' => $this->string(255)->defaultValue('en'),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-blog_translations-blog_id','{{%blog_translations}}','blog_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-blog_translations-blog_id','{{%blog_translations}}');
    }


    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%blog_translations}}');
    }
}
