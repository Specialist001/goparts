<?php

use yii\db\Migration;

/**
 * Class m190614_125108_add_fk_queries
 */
class m190614_125108_add_fk_queries extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-queries-user_id','{{%queries}}','user_id',false);
        $this->createIndex('idx-queries-car_id','{{%queries}}','car_id',false);
        $this->createIndex('idx-queries-category_id','{{%queries}}','category_id',false);

        $this->addForeignKey('fk-queries-user_id','{{%queries}}','user_id','{{%user}}','id','NO ACTION');
        $this->addForeignKey('fk-queries-car_id','{{%queries}}','car_id','{{%cars}}','id', 'NO ACTION');
        $this->addForeignKey('fk-queries-category_id','{{%queries}}','category_id','{{%store_categories}}','id','NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-queries-category_id','{{%queries}}');
        $this->dropForeignKey('fk-queries-car_id','{{%queries}}');
        $this->dropForeignKey('fk-queries-user_id','{{%queries}}');

        $this->dropIndex('idx-queries-category_id','{{%queries}}');
        $this->dropIndex('idx-queries-car_id','{{%queries}}');
        $this->dropIndex('idx-queries-user_id','{{%queries}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_125108_add_fk_queries cannot be reverted.\n";

        return false;
    }
    */
}
