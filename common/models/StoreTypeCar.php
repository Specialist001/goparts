<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_type_of_cars".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $external_id
 * @property string $slug
 * @property int $status
 * @property int $order
 * @property string $view
 * @property string $image
 *
 * @property StoreProductTypeOfCarValue[] $storeProductTypeOfCarValues
 * @property StoreProduct[] $storeProducts
 * @property StoreTypeCarTranslation[] $storeTypeOfCarTranslations
 * @property StoreTypeCar $parent
 * @property StoreTypeCar[] $storeTypeCars
 */
class StoreTypeCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_type_of_cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'order'], 'integer'],
            [['external_id', 'view'], 'string', 'max' => 100],
            [['slug', 'image'], 'string', 'max' => 255],
//            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreTypeCar::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'external_id' => 'External ID',
            'slug' => 'Slug',
            'status' => 'Status',
            'order' => 'Order',
            'view' => 'View',
            'image' => 'Image',
        ];
    }

    public static function find() {
        return parent::find()->with('translate');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActiveTypes()
    {
        return $this->hasMany(StoreTypeCar::className(), ['parent_id' => 'id'])->where(['status' => 1])->orderBy('order')->with('translate');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductTypeOfCarValues()
    {
        return $this->hasMany(StoreProductTypeOfCarValue::className(), ['type_car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['type_car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreTypeCarTranslation()
    {
        return $this->hasMany(StoreTypeCarTranslation::className(), ['type_car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(StoreTypeCar::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeCars()
    {
        return $this->hasMany(StoreTypeCar::className(), ['parent_id' => 'id']);
    }

    public function getTranslate() {
        return ($this->hasOne(StoreTypeCarTranslation::className(), ['type_car_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(StoreTypeCarTranslation::className(), ['type_car_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(StoreTypeCarTranslation::className(), ['type_car_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
