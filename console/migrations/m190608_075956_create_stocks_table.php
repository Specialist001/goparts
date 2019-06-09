<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stocks}}`.
 */
class m190608_075956_create_stocks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%stocks}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(11),
            'name' => $this->string(255)->null(),
            'description' => $this->text()->null(),
            'location' => $this->string()->null(),
        ]);

        $this->createIndex('idx-city_id','{{%stocks}}','city_id',false);
        $this->addForeignKey('fk-city_id','{{%stocks}}','city_id','{{%cities}}','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-city_id','{{%stocks}}');

        $this->dropIndex('idx-city_id','{{%stocks}}');

        $this->dropTable('{{%stocks}}');
    }
}
