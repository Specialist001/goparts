<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sitemaps}}`.
 */
class m190518_055220_create_sitemaps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%sitemaps}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'change_freq' => $this->string(30),
            'priority' => $this->float()->defaultValue(0.5),
            'status' => $this->smallInteger(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%sitemaps}}');
    }
}
