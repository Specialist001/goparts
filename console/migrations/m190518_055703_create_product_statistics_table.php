<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_statistics}}`.
 */
class m190518_055703_create_product_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_statistics}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'category_id' => $this->integer(11),
            'previews' => $this->integer(11)->null()->defaultValue(0),
            'views' => $this->integer(11)->null()->defaultValue(0),
            'purchases' => $this->integer(11)->null()->defaultValue(0),
            'favorites' => $this->integer(11)->null()->defaultValue(0),

            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('ix-product_statistics-product_id','{{%product_statistics}}','product_id',false);
        $this->createIndex('ix-product_statistics-user_id','{{%product_statistics}}','user_id',false);
        $this->createIndex('ix-product_statistics-category_id','{{%product_statistics}}','category_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ix-product_statistics-product_id','{{%product_statistics}}');
        $this->dropIndex('ix-product_statistics-user_id','{{%product_statistics}}');
        $this->dropIndex('ix-product_statistics-category_id','{{%product_statistics}}');

        $this->dropTable('{{%product_statistics}}');
    }
}
