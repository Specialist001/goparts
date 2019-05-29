<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_videos".
 *
 * @property int $id
 * @property int $product_id store_products->id
 * @property string $video
 * @property string $url
 *
 * @property StoreProducts $product
 */
class StoreProductVideo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['video', 'url'], 'string', 'max' => 255],
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
            'video' => 'Video',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
