<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_option_values}}`.
 */
class m190615_113519_create_store_option_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_option_values}}', [
            'id' => $this->primaryKey(),
            'option_id' => $this->integer(11),
            'value' => $this->string(255),
        ]);

        $this->createIndex('idx-store_option_values','{{%store_option_values}}','option_id',false);
        $this->addForeignKey('fk-store_option_values','{{%store_option_values}}','option_id','{{%store_options}}','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store_option_values','{{%store_option_values}}');
        $this->dropIndex('idx-store_option_values','{{%store_option_values}}');

        $this->dropTable('{{%store_option_values}}');
    }
}
