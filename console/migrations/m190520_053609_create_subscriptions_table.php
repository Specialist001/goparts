<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m190520_053609_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%subscriptions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null(),
            'category_id' => $this->integer(11),
            'email' => $this->string(255),
            'vendor' => $this->string(255)->null(),
            'car' => $this->string(255)->null(),
            'year' => $this->integer(4)->null(),
            'modification' => $this->string()->null(),

            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-subscriptions-user_id','{{%subscriptions}}','user_id',false);
    }

    public function safeDown()
    {
        $this->dropIndex('ix-subscriptions-user_id','{{%subscriptions}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%subscriptions}}');
    }
}
