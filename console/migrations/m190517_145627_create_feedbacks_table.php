<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedbacks}}`.
 */
class m190517_145627_create_feedbacks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedbacks}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->null(),
            'user_id' => $this->integer(11)->null(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(255)->null(),
            'theme' => $this->string(255),
            'text' => $this->text(),
            'type' => $this->smallInteger(2)->defaultValue(0),
            'answer' => $this->text(),
            'answer_time' => $this->integer(11)->null(),
            'is_faq' => $this->smallInteger(1)->defaultValue(0),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'ip' => $this->string(30),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-feedbacks-category_id', '{{%feedbacks}}', 'category_id', false);
        $this->createIndex('ix-feedbacks-user_id', '{{%feedbacks}}', 'user_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-feedbacks-category_id', '{{%feedbacks}}');
        $this->dropIndex('ix-feedbacks-user_id', '{{%feedbacks}}');

        $this->dropTable('{{%feedbacks}}');
    }
}
