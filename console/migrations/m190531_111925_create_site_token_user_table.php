<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%site_token_user}}`.
 */
class m190531_111925_create_site_token_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%site_token_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'token' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%site_token_user}}');
    }
}
