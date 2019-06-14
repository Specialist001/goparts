<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_commissions}}`.
 */
class m190614_060430_create_store_commissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_commissions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'commission' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_commissions}}');
    }
}
