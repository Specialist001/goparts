<?php

use yii\db\Migration;

/**
 * Handles adding reg_type to table `{{%user}}`.
 */
class m190714_124159_add_reg_type_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}','reg_type', $this->string(50)->null()->after('type')->comment('auto, manual'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
