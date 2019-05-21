<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%galleries_to_images}}`.
 */
class m190520_065255_create_galleries_to_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%galleries_to_images}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(11),
            'gallery_id' => $this->integer(11),
            'order' => $this->integer(11)->defaultValue(0),
        ]);
    }

    public function safeUp()
    {
        $this->createIndex('ix-galleries_to_images-image_id','{{%galleries_to_images}}','image_id',false);
        $this->createIndex('ix-galleries_to_images-gallery_id','{{%galleries_to_images}}','gallery_id',false);    }

    public function safeDown()
    {
        $this->dropIndex('ix-galleries_to_images-image_id','{{%galleries_to_images}}');
        $this->dropIndex('ix-galleries_to_images-gallery_id','{{%galleries_to_images}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {

        $this->dropTable('{{%galleries_to_images}}');
    }
}
