<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_images".
 *
 * @property int $id
 * @property int $product_id
 * @property string $link
 * @property string $title
 * @property int $group_id store_product_image_groups
 *
 * @property StoreProductImageGroup $group
 * @property StoreProduct $product
 */
class StoreProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'group_id'], 'integer'],
            [['link', 'title'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProductImageGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'link' => 'Link',
            'title' => 'Title',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(StoreProductImageGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
