<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_orders_to_coupon".
 *
 * @property int $id
 * @property int $order_id
 * @property int $coupon_id
 * @property int $created_at created date
 *
 * @property StoreCoupon $coupon
 * @property StoreOrder $order
 */
class StoreOrdersToCoupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_orders_to_coupon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'coupon_id', 'created_at'], 'integer'],
            [['created_at'], 'required'],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreCoupon::className(), 'targetAttribute' => ['coupon_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'coupon_id' => 'Coupon ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(StoreCoupon::className(), ['id' => 'coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(StoreOrder::className(), ['id' => 'order_id']);
    }
}
