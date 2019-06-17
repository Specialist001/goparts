<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seller_queries}}`.
 */
class m190615_055222_create_seller_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seller_queries}}', [
            'id' => $this->primaryKey(),
            'query_id' => $this->integer(11),
            'seller_id' => $this->integer(11),
            'product_id' => $this->integer(11)->null(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('idx-seller_queries-query_id','{{%seller_queries}}','query_id',false);
        $this->createIndex('idx-seller_queries-seller_id','{{%seller_queries}}','seller_id',false);
        $this->createIndex('idx-seller_queries-product_id','{{%seller_queries}}','product_id',false);

        $this->addForeignKey('fk-seller_queries-query_id','{{%seller_queries}}','query_id','{{%queries}}','id','NO ACTION');
        $this->addForeignKey('fk-seller_queries-seller_id','{{%seller_queries}}','seller_id','{{%user}}','id','NO ACTION');
        $this->addForeignKey('fk-seller_queries-product_id','{{%seller_queries}}','product_id','{{%store_products}}','id','NO ACTION');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-seller_queries-product_id','{{%seller_queries}}');
        $this->dropForeignKey('fk-seller_queries-seller_id','{{%seller_queries}}');
        $this->dropForeignKey('fk-seller_queries-query_id','{{%seller_queries}}');

        $this->dropIndex('idx-seller_queries-product_id','{{%seller_queries}}');
        $this->dropIndex('idx-seller_queries-seller_id','{{%seller_queries}}');
        $this->dropIndex('idx-seller_queries-query_id','{{%seller_queries}}');


        $this->dropTable('{{%seller_queries}}');
    }
}
