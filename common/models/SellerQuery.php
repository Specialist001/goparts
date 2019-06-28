<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "seller_queries".
 *
 * @property int $id
 * @property int $query_id
 * @property int $seller_id
 * @property int $product_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StoreProduct $product
 * @property Query $query
 * @property User $seller
 */
class SellerQuery extends \yii\db\ActiveRecord
{
    const STATUS_WAITED = 0;
    const STATUS_MODERATE = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_PURCHASED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seller_queries';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['query_id', 'seller_id', 'product_id', 'status', 'created_at', 'updated_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['query_id'], 'exist', 'skipOnError' => true, 'targetClass' => Query::className(), 'targetAttribute' => ['query_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'query_id' => 'Query ID',
            'seller_id' => 'Seller ID',
            'product_id' => 'Product ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getQuery()
    {
        return $this->hasOne(Query::className(), ['id' => 'query_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_id']);
    }
}
