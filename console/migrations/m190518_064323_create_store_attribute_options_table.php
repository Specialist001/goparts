<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_options}}`.
 */
class m190518_064323_create_store_attribute_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_attribute_options}}', [
            'id' => $this->primaryKey(),
            'attribute_id' => $this->integer(11),
            'order' => $this->integer(11)
        ]);

        $this->createIndex('ix-store_attribute_options-attribute_id','{{%store_attribute_options}}','attribute_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_attribute_options}}');
    }
}
