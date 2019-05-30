<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_payments".
 *
 * @property int $id
 * @property string $module
 * @property string $name
 * @property string $description
 * @property string $settings
 * @property int $currency_id
 * @property int $order
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property StoreDeliveryPayment[] $storeDeliveryPayments
 * @property StoreOrder[] $storeOrders
 * @property Currency $currency
 */
class StorePayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'settings'], 'string'],
            [['currency_id', 'order', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['module'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 255],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'name' => 'Name',
            'description' => 'Description',
            'settings' => 'Settings',
            'currency_id' => 'Currency ID',
            'order' => 'Order',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreDeliveryPayments()
    {
        return $this->hasMany(StoreDeliveryPayment::className(), ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrders()
    {
        return $this->hasMany(StoreOrder::className(), ['payment_method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}
