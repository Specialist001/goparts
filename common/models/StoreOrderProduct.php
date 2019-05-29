<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_order_products".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_name
 * @property string $variants
 * @property string $variants_text
 * @property string $price
 * @property int $quantity
 * @property string $sku
 *
 * @property StoreOrder $order
 * @property StoreProduct $product
 */
class StoreOrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_order_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['variants_text'], 'string'],
            [['price'], 'number'],
            [['product_name', 'variants'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 150],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'variants' => 'Variants',
            'variants_text' => 'Variants Text',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'sku' => 'Sku',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(StoreOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
