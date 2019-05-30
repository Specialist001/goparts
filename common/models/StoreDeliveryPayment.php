<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_delivery_payments".
 *
 * @property int $id
 * @property int $delivery_id
 * @property int $payment_id
 *
 * @property StoreDelivery $delivery
 * @property StorePayment $payment
 */
class StoreDeliveryPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_delivery_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['delivery_id', 'payment_id'], 'integer'],
            [['delivery_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreDelivery::className(), 'targetAttribute' => ['delivery_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => StorePayment::className(), 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_id' => 'Delivery ID',
            'payment_id' => 'Payment ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(StoreDelivery::className(), ['id' => 'delivery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(StorePayment::className(), ['id' => 'payment_id']);
    }
}
