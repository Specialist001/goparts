<?php

use yii\db\Migration;

/**
 * Class m190721_192859_add_manager_id_to_queries_table
 */
class m190721_192859_add_manager_id_to_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%queries}}','approve_manager_id', $this->integer(11)->null()->after('user_id')->comment('approved manager'));
        $this->addColumn('{{%queries}}','update_manager_id', $this->integer(11)->null()->after('approve_manager_id')->comment('update manager'));

        $this->createIndex('idx-queries-approve_manager_id','{{%queries}}','approve_manager_id',false);
        $this->createIndex('idx-queries-update_manager_id','{{%queries}}','update_manager_id',false);

        $this->addForeignKey('fk-queries-approve_manager_id','{{%queries}}','approve_manager_id','{{%user}}','id','NO ACTION');
        $this->addForeignKey('fk-queries-update_manager_id','{{%queries}}','update_manager_id','{{%user}}','id','NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190721_192859_add_manager_id_to_queries_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190721_192859_add_manager_id_to_queries_table cannot be reverted.\n";

        return false;
    }
    */
}
