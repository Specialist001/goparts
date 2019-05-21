<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_attribute_translations}}`.
 */
class m190518_060550_create_store_attribute_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_attribute_translations}}', [
            'id' => $this->primaryKey(),
            'attribute_id' => $this->integer(11),
            'locale' => $this->string(255)->defaultValue('en'),
            'title' => $this->string(255),
            'description' => $this->text()->null()
        ]);

    }

    public function safeUp()
    {
        $this->createIndex('ix-store_attribute_translations-attribute_id','{{%store_attribute_translations}}','attribute_id',false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-store_attribute_translations-attribute_id','{{%store_attribute_translations}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%store_attribute_translations}}');
    }
}
