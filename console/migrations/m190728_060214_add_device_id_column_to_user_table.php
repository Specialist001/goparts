<?php

use yii\db\Migration;

/**
 * Handles adding device_id to table `{{%user}}`.
 */
class m190728_060214_add_device_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}','device_id',$this->string(255)->null()->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
