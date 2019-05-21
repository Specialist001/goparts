<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_blog}}`.
 */
class m190517_132124_create_users_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%users_blog}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'blog_id' => $this->integer(11),

            'role' => $this->smallInteger(2)->defaultValue(1),
            'status' => $this->smallInteger(2)->defaultValue(1),
            'note' => $this->string(255)->null(),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%users_blog}}');
    }
}
