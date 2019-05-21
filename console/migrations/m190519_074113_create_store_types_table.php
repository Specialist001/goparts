<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_types}}`.
 */
class m190519_074113_create_store_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_types}}');
    }
}
