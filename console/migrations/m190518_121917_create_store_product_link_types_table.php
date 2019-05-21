<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product_link_types}}`.
 */
class m190518_121917_create_store_product_link_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%store_product_link_types}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(255),
            'title' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%store_product_link_types}}');
    }
}
