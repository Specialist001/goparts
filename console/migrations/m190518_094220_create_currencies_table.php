<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies}}`.
 */
class m190518094220_create_currencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'alpha_code' => $this->string(4)->defaultValue('AED'),
            'short' => $this->string(100)->defaultValue('Dirham'),
            'symbol' => $this->string(100)->defaultValue('Dh'),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'deleted_at' => $this->integer(11)->null(),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('uq-currencies-alpha_code','{{%currencies}}','alpha_code',true);
    }

    public function safeDown()
    {
        $this->dropIndex('uq-currencies-alpha_code','{{%currencies}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%currencies}}');
    }
}
