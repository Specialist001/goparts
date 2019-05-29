<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_links".
 *
 * @property int $id
 * @property int $type_id store_product_link_type->id
 * @property int $product_id store_products->id
 * @property int $linked_product_id store_products->id
 * @property int $order
 *
 * @property StoreProducts $linkedProduct
 * @property StoreProducts $product
 * @property StoreProductLinkTypes $type
 */
class StoreProductLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'product_id', 'linked_product_id', 'order'], 'integer'],
            [['linked_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['linked_product_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProductLinkType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'product_id' => 'Product ID',
            'linked_product_id' => 'Linked Product ID',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkedProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'linked_product_id']);
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
    public function getType()
    {
        return $this->hasOne(StoreProductLinkType::className(), ['id' => 'type_id']);
    }
}
