<?php

use yii\db\Migration;

/**
 * Handles adding main to table `{{%store_query_images}}`.
 */
class m190703_140912_add_main_column_to_store_query_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%query_images}}','main', $this->smallInteger(1)->notNull()->defaultValue('0')->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
