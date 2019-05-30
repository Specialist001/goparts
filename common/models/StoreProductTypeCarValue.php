<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_type_of_car_values".
 *
 * @property int $id
 * @property int $product_id store_products->id
 * @property int $type_car_id store_type_of_car->id
 * @property int $created_at
 *
 * @property StoreProducts $product
 * @property StoreTypeOfCars $typeCar
 */
class StoreProductTypeCarValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_type_of_car_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'type_car_id', 'created_at'], 'integer'],
            [['created_at'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['type_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreTypeCar::className(), 'targetAttribute' => ['type_car_id' => 'id']],
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
            'type_car_id' => 'Type Car ID',
            'created_at' => 'Created At',
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
    public function getTypeCar()
    {
        return $this->hasOne(StoreTypeCar::className(), ['id' => 'type_car_id']);
    }
}
