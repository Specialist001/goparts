<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%query_images}}`.
 */
class m190518_054748_create_query_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%query_images}}', [
            'id' => $this->primaryKey(),
            'query_id' => $this->integer(11),
            'name' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-query_images-query_id', '{{%query_images}}', 'query_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-query_images-query_id', '{{%query_images}}');

        $this->dropTable('{{%query_images}}');
    }
}
