<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m190517_155442_create_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->null(),
            'user_id' => $this->integer(11)->null(),
            'change_user_id' => $this->integer(11)->null(),
            'slug' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'is_protected' => $this->smallInteger(1)->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-pages-parent_id','{{%pages}}', 'parent_id', false);
        $this->createIndex('ix-pages-category_id','{{%pages}}', 'category_id', false);
        $this->createIndex('ix-pages-user_id','{{%pages}}', 'user_id', false);
        $this->createIndex('ix-pages-change_user_id','{{%pages}}', 'change_user_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-pages-parent_id','{{%pages}}');
        $this->dropIndex('ix-pages-category_id','{{%pages}}');
        $this->dropIndex('ix-pages-user_id','{{%pages}}');
        $this->dropIndex('ix-pages-change_user_id','{{%pages}}');

        $this->dropTable('{{%pages}}');
    }
}
