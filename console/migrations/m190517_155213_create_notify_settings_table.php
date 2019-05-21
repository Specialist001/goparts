<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notify_settings}}`.
 */
class m190517_155213_create_notify_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%notify_settings}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'my_post' => $this->smallInteger(1)->defaultValue(1),
            'my_comment' => $this->smallInteger(1)->defaultValue(1),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-notify_settings-user_id', '{{%notify_settings}}', 'user_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-notify_settings-user_id', '{{%notify_settings}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%notify_settings}}');
    }
}
