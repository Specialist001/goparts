<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attributes".
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property int $type
 * @property string $unit
 * @property int $required 0-no required, 1-required
 * @property int $order
 * @property int $is_filter
 *
 * @property StoreAttributeTranslation[] $storeAttributeTranslations
 * @property StoreAttributeGroup $group
 * @property StoreCategoryAttributeValue[] $storeCategoryAttributeValues
 * @property StoreProductAttributeValue[] $storeProductAttributeValues
 * @property StoreProductVariant[] $storeProductVariants
 * @property StoreTypeAttribute[] $storeTypeAttributes
 */
class StoreAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'type', 'required', 'order', 'is_filter'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 40],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttributeGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'name' => 'Name',
            'type' => 'Type',
            'unit' => 'Unit',
            'required' => 'Required',
            'order' => 'Order',
            'is_filter' => 'Is Filter',
        ];
    }

    /**
     * @return ActiveQuery
     */
//    public static function find() {
//
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttributeTranslations()
    {
        return $this->hasMany(StoreAttributeTranslation::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(StoreAttributeGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreCategoryAttributeValues()
    {
        return $this->hasMany(StoreCategoryAttributeValue::className(), ['store_attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductAttributeValues()
    {
        return $this->hasMany(StoreProductAttributeValue::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductVariants()
    {
        return $this->hasMany(StoreProductVariant::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreTypeAttributes()
    {
        return $this->hasMany(StoreTypeAttribute::className(), ['attribute_id' => 'id']);
    }

    public function getTranslate() {
        return ($this->hasOne(StoreAttributeTranslation::className(), ['attribute_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(StoreAttributeTranslation::className(), ['attribute_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(StoreAttributeTranslation::className(), ['attribute_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
