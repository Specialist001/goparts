<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_cart}}`.
 */
class m190618_122302_create_user_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
//            'car_id' => $this->integer(11)->notNull(),
//            'category_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(0),
            'count' => $this->integer(11),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('idx-user_cart-user_id','{{%user_cart}}','user_id', false);
        $this->addForeignKey('fk-user_cart-user_id','{{%user_cart}}','user_id','user','id', 'NO ACTION');

        $this->createIndex('idx-user_cart-product_id','{{%user_cart}}','product_id', false);
        $this->addForeignKey('fk-user_cart-product_id','{{%user_cart}}','product_id','store_products','id', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_cart-user_id','{{%user_cart}}');
        $this->dropIndex('idx-user_cart-user_id','{{%user_cart}}');

        $this->dropForeignKey('fk-user_cart-product_id','{{%user_cart}}');
        $this->dropIndex('idx-user_cart-product_id','{{%user_cart}}');

        $this->dropTable('{{%user_cart}}');
    }
}
