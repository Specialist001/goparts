<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_order_status".
 *
 * @property int $id
 * @property string $name
 * @property int $is_system
 * @property string $color
 *
 * @property StoreOrder[] $storeOrders
 */
class StoreOrderStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_order_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_system'], 'integer'],
            [['name', 'color'], 'string', 'max' => 255],
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
            'is_system' => 'Is System',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrders()
    {
        return $this->hasMany(StoreOrder::className(), ['status_id' => 'id']);
    }
}
