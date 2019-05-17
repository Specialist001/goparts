<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_translations}}`.
 */
class m190517_133151_create_category_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_translations}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11),
            'lang' => $this->char(2),
            'name' => $this->string(255),
            'short_description' => $this->text(),
            'description' => $this->text(),
        ]);

        $this->createIndex('ix-category_translations-category_id', '{{%category_translations}}', 'category_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-category_translations-category_id', '{{%category_translations}}');

        $this->dropTable('{{%category_translations}}');
    }
}
