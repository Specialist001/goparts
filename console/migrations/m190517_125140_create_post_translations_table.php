<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_translations}}`.
 */
class m190517_125140_create_post_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%post_translations}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en')->null(),
            'title' => $this->string(255),
            'content' => $this->text()->null(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
        ]);

        $this->createIndex('ix-post_translations-post_id', '{{%post_translations}}', 'post_id', false);
    }


    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%post_translations}}');
    }
}
