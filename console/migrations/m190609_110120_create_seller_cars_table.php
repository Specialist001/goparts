<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seller_cars}}`.
 */
class m190609_110120_create_seller_cars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%seller_cars}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'order' => $this->integer(11)->notNull(),
            'vendor_name' => $this->string(255),
        ]);

        $this->createIndex('idx-seller_cars-user_id','{{%seller_cars}}','user_id',false);
        $this->addForeignKey('fk-seller_cars-user_id','{{%seller_cars}}','user_id','user','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-seller_cars-user_id','{{%seller_cars}}');
        $this->dropIndex('idx-seller_cars-user_id','{{%seller_cars}}');

        $this->dropTable('{{%seller_cars}}');
    }
}
