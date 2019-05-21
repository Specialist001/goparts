<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages_translations}}`.
 */
class m190517_155453_create_page_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%page_translations}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en')->null(),
            'title' => $this->string(255),
            'title_short' => $this->string(255)->null(),
            'body' => $this->text(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
        ]);
        $this->createIndex('ix-page_translations-page_id', '{{%page_translations}}', 'page_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%page_translations}}');
    }
}
