<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_group_translations}}`.
 */
class m190518_061052_create_store_attribute_group_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_attribute_group_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_group_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en'),
            'name' => $this->string(255)->null(),
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-store_attribute_group_translations-attribute_group_id',
            '{{%store_attribute_group_translations}}','attribute_group_id',false);

    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_attribute_group_translations-attribute_group_id',
            '{{%store_attribute_group_translations}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_attribute_group_translations}}');
    }
}
