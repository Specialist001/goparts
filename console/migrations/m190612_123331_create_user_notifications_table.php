<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_notifications}}`.
 */
class m190612_123331_create_user_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_notifications}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'title' => $this->string(255),
            'description' => $this->string(255)->null(),
            'priority' => $this->smallInteger(2)->defaultValue(1)->comment('1-normal priority, 2-medium priority, 3-high priority'),
            'status' => $this->smallInteger(1)->defaultValue(0)->comment('0-not read, 1-read'),

        ]);

        $this->createIndex('idx-user_notifications-user_id','{{%user_notifications}}','user_id',false);
        $this->addForeignKey('fk-user_notifications-user_id','{{%user_notifications}}','user_id','user','id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_notifications-user_id','{{%user_notifications}}');
        $this->dropIndex('idx-user_notifications-user_id','{{%user_notifications}}');
        
        $this->dropTable('{{%user_notifications}}');
    }
}
