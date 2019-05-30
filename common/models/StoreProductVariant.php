<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_variants".
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $attribute_value
 * @property double $amount
 * @property int $type
 * @property string $sku
 * @property int $order
 *
 * @property StoreAttributes $attribute0
 * @property StoreProducts $product
 */
class StoreProductVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_variants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'type', 'order'], 'integer'],
            [['amount'], 'number'],
            [['attribute_value'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 150],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
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
            'attribute_id' => 'Attribute ID',
            'attribute_value' => 'Attribute Value',
            'amount' => 'Amount',
            'type' => 'Type',
            'sku' => 'Sku',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(StoreAttribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
