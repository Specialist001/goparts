<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store_orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $delivery_id
 * @property int $status_id
 * @property int $manager_id
 * @property string $delivery_price
 * @property int $payment_method_id
 * @property int $paid
 * @property int $payment_time
 * @property string $payment_details
 * @property string $total_price
 * @property string $discount
 * @property string $coupon_discount
 * @property int $separate_delivery
 * @property string $name
 * @property string $street
 * @property string $phone
 * @property string $email
 * @property string $comment
 * @property string $ip
 * @property string $url
 * @property string $note
 * @property string $zipcode
 * @property string $country
 * @property string $city
 * @property string $house
 * @property string $apartment
 * @property int $created_at created date
 * @property int $updated_at modified date
 *
 * @property StoreOrderProduct[] $storeOrderProducts
 * @property StoreDelivery $delivery
 * @property User $manager
 * @property StorePayment $paymentMethod
 * @property StoreOrderStatus $status
 * @property User $user
 * @property StoreOrdersToCoupon[] $storeOrdersToCoupons
 */
class StoreOrder extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_PICKED_UP = 4;
    const STATUS_NOT_PICKED_UP = 5;
    const STATUS_RETURNED = 6;

    const NOT_PAID = 0;
    const PAID = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery_id', 'status', 'manager_id', 'payment_method_id', 'paid', 'payment_time', 'separate_delivery', 'created_at', 'updated_at'], 'integer'],
            [['delivery_price', 'total_price', 'discount', 'coupon_discount'], 'number'],
            [['payment_details', 'comment', 'note'], 'string'],
//            [['created_at', 'updated_at'], 'required'],
            [['name', 'street', 'phone', 'email', 'url', 'country', 'city', 'house', 'apartment'], 'string', 'max' => 255],
            [['ip', 'zipcode'], 'string', 'max' => 30],
//            [['delivery_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreDelivery::className(), 'targetAttribute' => ['delivery_id' => 'id']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['manager_id' => 'id']],
            [['payment_method_id'], 'exist', 'skipOnError' => true, 'targetClass' => StorePayment::className(), 'targetAttribute' => ['payment_method_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'delivery_id' => 'Delivery ID',
            'status' => 'Status',
            'manager_id' => 'Manager ID',
            'delivery_price' => 'Delivery Price',
            'payment_method_id' => 'Payment Method ID',
            'paid' => 'Paid',
            'payment_time' => 'Payment Time',
            'payment_details' => 'Payment Details',
            'total_price' => 'Total Price',
            'discount' => 'Discount',
            'coupon_discount' => 'Coupon Discount',
            'separate_delivery' => 'Separate Delivery',
            'name' => 'Name',
            'street' => 'Street',
            'phone' => 'Phone',
            'email' => 'Email',
            'comment' => 'Comment',
            'ip' => 'Ip',
            'url' => 'Url',
            'note' => 'Note',
            'zipcode' => 'Zipcode',
            'country' => 'Category',
            'city' => 'City',
            'house' => 'House',
            'apartment' => 'Apartment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
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
    public function getStoreOrderProducts()
    {
        return $this->hasMany(StoreOrderProduct::className(), ['order_id' => 'id']);
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
    public function getManager()
    {
        return $this->hasOne(User::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(StorePayment::className(), ['id' => 'payment_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StoreOrderStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrdersToCoupons()
    {
        return $this->hasMany(StoreOrdersToCoupon::className(), ['order_id' => 'id']);
    }

}
