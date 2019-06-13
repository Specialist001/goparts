<?php

use yii\db\Migration;

/**
 * Class m190612_103541_add_car_id_column_to_store_products
 */
class m190612_103541_add_car_id_column_to_store_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%store_products}}', 'car_id', $this->integer(1)->null()->after('id'));

        $this->createIndex('idx-store_products-car_id','{{%store_products}}','car_id',false);
        $this->addForeignKey('fk-store_products-car_id','{{%store_products}}','car_id','cars','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store_products-car_id','{{%store_products}}');
        $this->dropIndex('idx-store_products-car_id','{{%store_products}}');
        $this->dropColumn('{{%store_products}}', 'car_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_103541_add_car_id_column_to_store_products cannot be reverted.\n";

        return false;
    }
    */
}
