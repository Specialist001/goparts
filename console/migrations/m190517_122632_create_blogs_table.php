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
    public function safeUp()
    {
        $this->createTable('{{%blogs}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->null(),
            'create_user_id' => $this->integer(11),
            'update_user_id' => $this->integer(11),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'icon' => $this->string(255),
            'slug' => $this->string(160),
            'lang' => $this->char(2)->null(),
            'type' => $this->smallInteger(2)->defaultValue(1),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'member_status' => $this->smallInteger(1)->defaultValue(1),
            'post_status' => $this->smallInteger(1)->defaultValue(1),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-blogs_category_id', '{{%blogs}}', 'category_id', false);
        $this->createIndex('ix-blogs_create_user', '{{%blogs}}', 'create_user_id', false);
        $this->createIndex('ix-blogs_update_user', '{{%blogs}}', 'update_user_id', false);
        //$this->createIndex('ix-blogs_status', '{{%blogs}}', 'status', false);
        $this->createIndex('ix-blogs_type', '{{%blogs}}', 'type', false);
        $this->createIndex('ix-blogs_lang', '{{%blogs}}', 'lang', false);
        $this->createIndex('ix-blogs_slug', '{{%blogs}}', 'slug', false);

        //$this->createIndex('uq_slug', '{{%blogs}}', 'slug' ,false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix_blogs_category_id', '{{%blogs}}');
        $this->dropIndex('ix-blogs_create_user', '{{%blogs}}');
        $this->dropIndex('ix-blogs_update_user', '{{%blogs}}');
        //$this->dropIndex('ix-blogs_status', '{{%blogs}}');
        $this->dropIndex('ix-blogs_type', '{{%blogs}}');
        $this->dropIndex('ix-blogs_lang', '{{%blogs}}');
        $this->dropIndex('ix-blogs_slug', '{{%blogs}}');

        //$this->dropIndex('uq_slug', '{{%blogs}}');

        $this->dropTable('{{%blogs}}');
    }
}
