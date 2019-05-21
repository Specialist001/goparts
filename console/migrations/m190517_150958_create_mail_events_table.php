<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mail_events}}`.
 */
class m190517_150958_create_mail_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%mail_events}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(150),
            'name' => $this->string(255),
            'description' => $this->text()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%mail_events}}');
    }
}
