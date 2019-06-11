<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_commission}}`.
 */
class m190610_122644_create_user_commission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_commission}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'commission' => $this->integer(11),
        ]);

        $this->createIndex('idx-user_commission-user_id','{{%user_commission}}','user_id',false);
        $this->addForeignKey('fk-user_commission-user_id','{{%user_commission}}','user_id','{{%user}}','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_commission-user_id','{{%user_commission}}');
        $this->dropIndex('idx-user_commission-user_id','{{%user_commission}}');
        $this->dropTable('{{%user_commission}}');
    }
}
