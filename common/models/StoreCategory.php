<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store_categories".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $slug
 * @property string $image
 * @property int $status
 * @property int $order
 * @property int $view
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductStatistics[] $productStatistics
 * @property StoreCategory $parent
 * @property StoreCategoryAttributeValues[] $storeCategoryAttributeValues
 * @property StoreProductToCategory[] $storeProductToCategories
 * @property StoreProducts[] $storeProducts
 */
class StoreCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'order', 'view', 'created_at', 'updated_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['slug', 'image'], 'string', 'max' => 255],
            //[['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'slug' => 'Slug',
            'image' => 'Image',
            'status' => 'Status',
            'order' => 'Order',
            'view' => 'View',
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

    public static function find() {
        return parent::find()->with('translate');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(StoreCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStatistics()
    {
        return $this->hasMany(ProductStatistics::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(StoreCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreCategoryAttributeValues()
    {
        return $this->hasMany(StoreCategoryAttributeValues::className(), ['store_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductToCategories()
    {
        return $this->hasMany(StoreProductToCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProducts::className(), ['category_id' => 'id']);
    }

    public function getTranslate() {
        return ($this->hasOne(StoreCategoryTranslation::className(), ['category_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(StoreCategoryTranslation::className(), ['category_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(StoreCategoryTranslation::className(), ['category_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
