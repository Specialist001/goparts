<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu_items}}`.
 */
class m190517_152323_create_menu_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu_items}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11),
            'menu_id' => $this->integer(11),
            'regular_link' => $this->smallInteger(1)->defaultValue(0),
            'title' => $this->string(255),
            'href' => $this->string(255),
            'class' => $this->string(255)->null(),
            'title_attr' => $this->string(255)->null(),
            'before_link' => $this->string(255)->null(),
            'after_link' => $this->string(255)->null(),
            'target' => $this->string(255)->null(),
            'rel' => $this->string(255)->null(),
            'condition_name' => $this->string(255)->null()->defaultValue(0),
            'condition_denial' => $this->integer(11)->null()->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(1),
            'status' => $this->integer(11)->defaultValue(1)
        ]);

        $this->createIndex('ix-menu_items-parent_id','{{%menu_items}}', 'parent_id', false);
        $this->createIndex('ix-menu_items-menu_id','{{%menu_items}}', 'menu_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu_items}}');
    }
}
