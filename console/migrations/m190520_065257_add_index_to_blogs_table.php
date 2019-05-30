<?php

use yii\db\Migration;

/**
 * Class m190520065250_add_index_to_blogs_table
 */
class m190520_065257_add_index_to_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createIndex('ix-users_blog-user_id', '{{%users_blog}}','user_id', false);
        $this->createIndex('ix-users_blog-blog_id', '{{%users_blog}}','blog_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex('ix-users_blog-user_id', '{{%users_blog}}');
        $this->dropIndex('ix-users_blog-blog_id', '{{%users_blog}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190520065250_add_index_to_blogs_table cannot be reverted.\n";

        return false;
    }
    */
}
