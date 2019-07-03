<?php

use yii\db\Migration;

/**
 * Handles adding main to table `{{%store_product_image}}`.
 */
class m190703_083024_add_main_column_to_store_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%store_product_images}}','main', $this->smallInteger(1)->notNull()->defaultValue('0')->after('title'));
        $this->addColumn('{{%store_product_images}}','created_at', $this->integer(11)->notNull());
        $this->addColumn('{{%store_product_images}}','updated_at', $this->integer(11)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
