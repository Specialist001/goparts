<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_attributes".
 *
 * @property int $id
 * @property int $product_id store_products->id
 * @property int $type_id store_types->id
 *
 * @property StoreProduct $product
 * @property StoreType $type
 */
class StoreProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'type_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(StoreType::className(), ['id' => 'type_id']);
    }
}
