<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs}}`.
 */
class m190517_122632_create_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%blogs}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->null(),
            'create_user_id' => $this->integer(11),
            'update_user_id' => $this->integer(11),
            'icon' => $this->string(255),
            'slug' => $this->string(160),
            'type' => $this->smallInteger(2)->defaultValue(1),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'member_status' => $this->smallInteger(1)->defaultValue(1),
            'post_status' => $this->smallInteger(1)->defaultValue(1),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-blogs_category_id', '{{%blogs}}', 'category_id', false);
        $this->createIndex('ix-blogs_create_user_id', '{{%blogs}}', 'create_user_id', false);
        $this->createIndex('ix-blogs_update_user_id', '{{%blogs}}', 'update_user_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix_blogs_category_id', '{{%blogs}}');
        $this->dropIndex('ix-blogs_create_user_id', '{{%blogs}}');
        $this->dropIndex('ix-blogs_update_user_id', '{{%blogs}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        //$this->dropIndex('uq_slug', '{{%blogs}}');

        $this->dropTable('{{%blogs}}');
    }




}
