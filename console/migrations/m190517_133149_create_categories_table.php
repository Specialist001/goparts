<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m190517_133149_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->null(),
            'slug' => $this->string(150),
            'image' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(0),
        ]);

        $this->createIndex('ix-categories-parent_id', '{{%categories}}', 'parent_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-categories-parent_id', '{{%categories}}');

        $this->dropTable('{{%categories}}');
    }
}
