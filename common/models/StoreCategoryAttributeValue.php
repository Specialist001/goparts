<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_category_attribute_values".
 *
 * @property int $id
 * @property int $store_category_id
 * @property int $store_attribute_id
 * @property int $store_option_id
 * @property double $number_value
 * @property string $string_value
 * @property string $text_value
 * @property int $created_at
 *
 * @property StoreAttribute $storeAttribute
 * @property StoreCategory $storeCategory
 * @property StoreAttributeOption $storeOption
 */
class StoreCategoryAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_category_attribute_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_category_id', 'store_attribute_id', 'store_option_id', 'created_at'], 'integer'],
            [['number_value'], 'number'],
            [['text_value'], 'string'],
            [['created_at'], 'required'],
            [['string_value'], 'string', 'max' => 255],
            [['store_attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['store_attribute_id' => 'id']],
            [['store_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreCategory::className(), 'targetAttribute' => ['store_category_id' => 'id']],
            [['store_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttributeOption::className(), 'targetAttribute' => ['store_option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_category_id' => 'Store Category ID',
            'store_attribute_id' => 'Store Attribute ID',
            'store_option_id' => 'Store Option ID',
            'number_value' => 'Number Value',
            'string_value' => 'String Value',
            'text_value' => 'Text Value',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttribute()
    {
        return $this->hasOne(StoreAttribute::className(), ['id' => 'store_attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreCategory()
    {
        return $this->hasOne(StoreCategory::className(), ['id' => 'store_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOption()
    {
        return $this->hasOne(StoreAttributeOption::className(), ['id' => 'store_option_id']);
    }
}
