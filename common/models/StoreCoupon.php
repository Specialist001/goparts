<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_coupons".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $type
 * @property string $value
 * @property string $min_order_price
 * @property int $registered_user
 * @property int $free_shipping
 * @property int $start_time
 * @property int $end_time
 * @property int $quantity
 * @property int $quantity_per_user
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StoreOrdersToCoupon[] $storeOrdersToCoupons
 */
class StoreCoupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_coupons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'registered_user', 'free_shipping', 'start_time', 'end_time', 'quantity', 'quantity_per_user', 'status', 'created_at', 'updated_at'], 'integer'],
            [['value', 'min_order_price'], 'number'],
            [['created_at', 'updated_at'], 'required'],
            [['name', 'code'], 'string', 'max' => 255],
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
            'code' => 'Code',
            'type' => 'Type',
            'value' => 'Value',
            'min_order_price' => 'Min Order Price',
            'registered_user' => 'Registered User',
            'free_shipping' => 'Free Shipping',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'quantity' => 'Quantity',
            'quantity_per_user' => 'Quantity Per User',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrdersToCoupons()
    {
        return $this->hasMany(StoreOrdersToCoupon::className(), ['coupon_id' => 'id']);
    }
}
