<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_image_groups".
 *
 * @property int $id
 * @property string $name
 *
 * @property StoreProductImages[] $storeProductImages
 */
class StoreProductImageGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_image_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductImages()
    {
        return $this->hasMany(StoreProductImage::className(), ['group_id' => 'id']);
    }
}
