<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_to_blogs}}`.
 */
class m190517_132124_create_user_to_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%user_to_blogs}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'blog_id' => $this->integer(11),

            'role' => $this->smallInteger(2)->defaultValue(1),
            'status' => $this->smallInteger(2)->defaultValue(1),
            'note' => $this->string(255),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

            }

    public function safeUp()
    {
        $this->createIndex('ix-user_to_blogs-user_id', '{{$user_to_blogs}}','user_id', false);
        $this->createIndex('ix-user_to_blogs-blog_id', '{{$user_to_blogs}}','blog_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-user_to_blogs-user_id', '{{$user_to_blogs}}');
        $this->dropIndex('ix-user_to_blogs-blog_id', '{{$user_to_blogs}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%user_to_blogs}}');
    }
}
