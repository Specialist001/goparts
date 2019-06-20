<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store_deliveries".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property double $free_form
 * @property double $available_form
 * @property int $order
 * @property int $status
 * @property int $separate_payment
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property StoreDeliveryPayments[] $storeDeliveryPayments
 * @property StoreOrders[] $storeOrders
 */
class StoreDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_deliveries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'free_form', 'available_form'], 'number'],
            [['order', 'status', 'separate_payment', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
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
            'description' => 'Description',
            'price' => 'Price',
            'free_form' => 'Free Form',
            'available_form' => 'Available Form',
            'order' => 'Order',
            'status' => 'Status',
            'separate_payment' => 'Separate Payment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreDeliveryPayments()
    {
        return $this->hasMany(StoreDeliveryPayment::className(), ['delivery_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrders()
    {
        return $this->hasMany(StoreOrder::className(), ['delivery_id' => 'id']);
    }
}
