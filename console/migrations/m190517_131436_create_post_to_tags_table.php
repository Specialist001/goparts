<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_to_tags}}`.
 */
class m190517_131436_create_post_to_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_to_tags}}', [
            'post_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
        ]);

        $this->createIndex('ix-post_to_tags-post_id', '{{%post_to_tags}}', 'post_id',false);
        $this->createIndex('ix-post_to_tags-tag_id', '{{%post_to_tags}}', 'tag_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-post_to_tags-post_id', '{{%post_to_tags}}');
        $this->dropIndex('ix-post_to_tags-tag_id', '{{%post_to_tags}}');

        $this->dropTable('{{%post_to_tags}}');
    }
}
