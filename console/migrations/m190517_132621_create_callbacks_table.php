<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%callbacks}}`.
 */
class m190517_132621_create_callbacks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%callbacks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->null(),
            'phone' => $this->string(255)->null(),
            'time' => $this->string(255)->null(),
            'comment' => $this->string(255)->null(),
            'status' => $this->smallInteger(1)->null()->defaultValue(0),
            'url' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%callbacks}}');
    }
}
