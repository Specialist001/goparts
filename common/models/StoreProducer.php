<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_producers".
 *
 * @property int $id
 * @property string $name_short
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $short_description
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $order
 * @property int $status
 * @property int $view
 *
 * @property StoreProduct[] $storeProducts
 */
class StoreProducer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_producers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'meta_keywords'], 'string'],
            [['order', 'status', 'view'], 'integer'],
            [['name_short'], 'string', 'max' => 150],
            [['name', 'slug', 'image', 'short_description', 'meta_title', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_short' => 'Name Short',
            'name' => 'Name',
            'slug' => 'Slug',
            'image' => 'Image',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'order' => 'Order',
            'status' => 'Status',
            'view' => 'View',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['producer_id' => 'id']);
    }
}
