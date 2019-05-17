<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mail_templates}}`.
 */
class m190517_151205_create_mail_templates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mail_templates}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(11),
            'code' => $this->string(150),
            'name' => $this->string(255),
            'description' => $this->text()->null(),
            'from' => $this->string(255),
            'to' => $this->string(255),
            'theme' => $this->text(),
            'body' => $this->text(),
            'status' => $this->integer(11)->defaultValue(1),
        ]);

        $this->createIndex('ix-mail_templates-event_id', '{{%mail_templates}}', 'event_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-mail_templates-event_id', '{{%mail_templates}}');

        $this->dropTable('{{%mail_templates}}');
    }
}
