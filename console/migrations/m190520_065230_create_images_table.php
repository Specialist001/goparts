<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m190520_065230_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null(),
            'parent_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11)->null(),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'file' => $this->string(255),
            'order' => $this->integer(11)->defaultValue(0),
            'type' => $this->smallInteger(2)->defaultValue(0),
            'status' => $this->smallInteger(1)->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-images-user_id','{{%images}}','user_id',false);
        $this->createIndex('ix-images-parent_id','{{%images}}','parent_id',false);
        $this->createIndex('ix-images-category_id','{{%images}}','category_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%images}}');
    }
}
