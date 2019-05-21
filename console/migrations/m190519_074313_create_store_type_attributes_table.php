<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_type_attributes}}`.
 */
class m190519_074313_create_store_type_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_type_attributes}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(11)->comment('store_type->id  '),
            'attribute_id' => $this->integer(11)->comment('store_attribute->id  '),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-store_type_attributes-type_id','{{%store_type_attributes}}','type_id', false);
        $this->createIndex('ix-store_type_attributes-attribute_id','{{%store_type_attributes}}','attribute_id', false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_type_attributes-type_id','{{%store_type_attributes}}');
        $this->dropIndex('ix-store_type_attributes-attribute_id','{{%store_type_attributes}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_type_attributes}}');
    }
}
