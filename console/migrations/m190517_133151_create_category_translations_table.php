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
    public function up()
    {
        $this->createTable('{{%category_translations}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en'),
            'name' => $this->string(255),
            'short_description' => $this->text(),
            'description' => $this->text(),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-category_translations-category_id', '{{%category_translations}}', 'category_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-category_translations-category_id', '{{%category_translations}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%category_translations}}');
    }
}
