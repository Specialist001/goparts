<?php

use yii\db\Migration;

/**
 * Handles adding default to table `{{%cities}}`.
 */
class m190611_063450_add_default_column_to_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%cities}}', 'default', $this->smallInteger(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        return false;
    }
}
