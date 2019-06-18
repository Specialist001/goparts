<?php

namespace app\models;

use common\models\StoreProduct;
use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_cart".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $status
 * @property int $count
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class UserCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'product_id', 'status', 'count', 'created_at', 'updated_at'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => 'Product ID',
            'status' => 'Status',
            'count' => 'Count',
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
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
