<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attribute_options".
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $order
 *
 * @property StoreAttributeOptionTranslation[] $storeAttributeOptionTranslations
 * @property StoreAttributeGroup $attribute0
 * @property StoreCategoryAttributeValue[] $storeCategoryAttributeValues
 * @property StoreProductAttributeValue[] $storeProductAttributeValues
 */
class StoreAttributeOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attribute_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id', 'order'], 'integer'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Attribute ID',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttributeOptionTranslations()
    {
        return $this->hasMany(StoreAttributeOptionTranslation::className(), ['attribute_option_id' => 'id']);
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
    public function getStoreCategoryAttributeValues()
    {
        return $this->hasMany(StoreCategoryAttributeValue::className(), ['store_option_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductAttributeValues()
    {
        return $this->hasMany(StoreProductAttributeValue::className(), ['option_id' => 'id']);
    }

    public function getTranslate() {
        return ($this->hasOne(StoreAttributeOptionTranslation::className(), ['attribute_option_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(StoreAttributeOptionTranslation::className(), ['attribute_option_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(StoreAttributeOptionTranslation::className(), ['attribute_option_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
