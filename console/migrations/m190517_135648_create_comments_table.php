<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m190517_135648_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->null(),
            'user_id' => $this->integer(11)->null(),
            'model_id' => $this->integer(11)->null(),
            'model' => $this->string(255)->null(),
            'url' => $this->string(255)->null(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'text' => $this->text(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'ip' => $this->string(30)->null(),
            'level' => $this->integer(11)->null()->defaultValue(0),
            'root' => $this->integer(11)->null()->defaultValue(0),
            'left' => $this->integer(11)->null()->defaultValue(0),
            'right' => $this->integer(11)->null()->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-comments-parent_id', '{{%comments}}', 'parent_id');
        $this->createIndex('ix-comments-user_id', '{{%comments}}', 'user_id');
    }

    public function safeDown()
    {
        $this->dropIndex('ix-comments-parent_id', '{{%comments}}');
        $this->dropIndex('ix-comments-user_id', '{{%comments}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%comments}}');
    }
}
