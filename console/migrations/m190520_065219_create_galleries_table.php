<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%galleries}}`.
 */
class m190520_065219_create_galleries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%galleries}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'user_id' => $this->integer(11)->null(),
            'preview_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->null(),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-galleries-user_id','{{%galleries}}','user_id',false);
        $this->createIndex('ix-galleries-preview_id','{{%galleries}}','preview_id',false);
        $this->createIndex('ix-galleries-category_id','{{%galleries}}','category_id',false);    }

    public function safeDown()
    {
        $this->dropIndex('ix-galleries-user_id','{{%galleries}}');
        $this->dropIndex('ix-galleries-preview_id','{{%galleries}}');
        $this->dropIndex('ix-galleries-category_id','{{%galleries}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%galleries}}');
    }
}
