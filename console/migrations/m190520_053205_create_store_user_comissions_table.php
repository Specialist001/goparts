<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_user_comissions}}`.
 */
class m190520_053205_create_store_user_comissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_user_comissions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null(),
            'commission' => $this->integer(11)->null()->defaultValue(8),
        ]);

        $this->createIndex('ix-store_user_comissions-user_id','{{%store_user_comissions}}','user_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_user_comissions}}');
    }
}
