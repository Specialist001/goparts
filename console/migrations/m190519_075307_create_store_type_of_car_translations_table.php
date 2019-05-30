<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_type_of_car_translations}}`.
 */
class m190519_075307_create_store_type_of_car_translations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_type_of_car_translations}}', [
            'id' => $this->primaryKey(),
            'type_car_id' => $this->integer(11)->notNull(),
            'locale' => $this->string(255)->notNull()->defaultValue('en-EN'),
            'name' => $this->string(255)->notNull(),
        ]);
        $this->createIndex('ix-store_type_of_car_translations-type_car_id','{{%store_type_of_car_translations}}','type_car_id', false);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_type_of_car_translations}}');
    }
}
