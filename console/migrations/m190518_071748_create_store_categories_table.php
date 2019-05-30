<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_categories}}`.
 */
class m190518_071748_create_store_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_categories}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->null(),
            'slug' => $this->string(255),
            'image' => $this->string(255)->null(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),
            'view' => $this->integer(11)->null()->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-store_categories-parent_id','store_categories','parent_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_categories}}');
    }
}
