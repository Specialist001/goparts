<?php

use yii\db\Migration;

/**
 * Class m190721_202542_add_manager_id_to_seller_queries_table
 */
class m190721_202542_add_manager_id_to_seller_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%seller_queries}}','sent_manager_id', $this->integer(11)->null()->after('seller_id')->comment('sent manager'));

        $this->createIndex('idx-seller_queries-sent_manager_id','{{%seller_queries}}','sent_manager_id',false);

        $this->addForeignKey('fk-seller_queries-sent_manager_id','{{%seller_queries}}','sent_manager_id','{{%user}}','id','NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190721_202542_add_manager_id_to_seller_queries_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190721_202542_add_manager_id_to_seller_queries_table cannot be reverted.\n";

        return false;
    }
    */
}
