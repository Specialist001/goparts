<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m190517_125134_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer(11),
            'category_id' => $this->integer(11)->null(),
            'create_user_id' => $this->integer(11),
            'update_user_id' => $this->integer(11),
            'slug' => $this->string(160),
            'quote' => $this->text()->null(),
            'link' => $this->string(255),
            'create_user_ip' => $this->string(30),
            'access_type' => $this->integer(11)->defaultValue(1),
            'image' => $this->string(255)->null(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'comment_status' => $this->smallInteger(1)->defaultValue(1),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'published_at' => $this->integer(11),
        ]);

        $this->createIndex('ix-posts_blog_id', '{{%posts}}', 'blog_id', false);
        $this->createIndex('ix-posts_category_id', '{{%posts}}', 'category_id', false);
        $this->createIndex('ix-posts_create_user_id', '{{%posts}}', 'create_user_id', false);
        $this->createIndex('ix-posts_update_user_id', '{{%posts}}', 'update_user_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%posts}}');
    }
}
