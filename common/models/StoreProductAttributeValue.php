<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_attribute_values".
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property int $option_id
 * @property double $number_value
 * @property string $string_value
 * @property string $text_value
 * @property int $created_at
 *
 * @property StoreAttributes $attribute0
 * @property StoreAttributeOptions $option
 * @property StoreProducts $product
 */
class StoreProductAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_attribute_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'option_id', 'created_at'], 'integer'],
            [['number_value'], 'number'],
            [['text_value'], 'string'],
            [['created_at'], 'required'],
            [['string_value'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttributeOption::className(), 'targetAttribute' => ['option_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'option_id' => 'Option ID',
            'number_value' => 'Number Value',
            'string_value' => 'String Value',
            'text_value' => 'Text Value',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(StoreAttribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(StoreAttributeOption::className(), ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
