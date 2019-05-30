<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m190517_153431_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->null(),
            'user_id' => $this->integer(11)->null(),
            'image' => $this->string(255)->null(),
            'link' => $this->string(255)->null(),
            'status' => $this->smallInteger(2)->defaultValue(0),
            'is_protected' => $this->smallInteger(1)->defaultValue(0),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
