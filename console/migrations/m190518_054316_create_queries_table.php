<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queries}}`.
 */
class m190518_054316_create_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%queries}}', [
            'id' => $this->primaryKey(),
            'own' => $this->integer(11)->null(),
            'vendor' => $this->string(255)->null(),
            'car' => $this->string(255)->null(),
            'year' => $this->string(255)->null(),
            'modification' => $this->string(255)->null(),
            'fueltype' => $this->string(255)->null(),
            'engine' => $this->string(255)->null(),
            'transmission' => $this->string(255)->null(),
            'drivetype' => $this->string(255)->null(),
            'name' => $this->string(255)->null(),
            'image' => $this->string(255)->null(),
            'status' => $this->smallInteger(1)->defaultValue(2),

            'created_at' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%queries}}');
    }
}
