<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store_products".
 *
 * @property int $id
 * @property int $type_id
 * @property int $producer_id
 * @property int $category_id
 * @property int $car_id
 * @property int $type_car_id
 * @property int $user_id
 * @property string $sku
 * @property string $serial_number
 * @property string $slug
 * @property string $price
 * @property string $discount_price
 * @property string $discount
 * @property string $data
 * @property int $is_special
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $weight
 * @property int $quantity
 * @property int $in_stock
 * @property int $status
 * @property string $title
 * @property string $image
 * @property string $average_price
 * @property string $purchase_price
 * @property string $recommended_price
 * @property int $order
 * @property string $external_id
 * @property int $view
 * @property int $qid
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductStatistic[] $productStatistics
 * @property StoreOrderProduct[] $storeOrderProducts
 * @property StoreProductAttributeValue[] $storeProductAttributeValues
 * @property StoreProductAttribute[] $storeProductAttributes
 * @property StoreProductCommission[] $storeProductCommissions
 * @property StoreProductImage[] $storeProductImages
 * @property StoreProductLink[] $storeProductLinks
 * @property StoreProductLink[] $storeProductLinks0
 * @property StoreProductToCar[] $storeProductToCars
 * @property StoreProductToCategory[] $storeProductToCategories
 * @property StoreProductTranslation[] $storeProductTranslations
 * @property StoreProductTypeCarValue[] $storeProductTypeOfCarValues
 * @property StoreProductVariant[] $storeProductVariants
 * @property StoreProductVideo[] $storeProductVideos
 * @property StoreCategory $category
 * @property StoreProducer $producer
 * @property StoreTypeCar $typeCar
 * @property StoreType $type
 * @property User $user
 */
class StoreProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_products';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'car_id', 'producer_id', 'category_id', 'type_car_id', 'user_id', 'quantity', 'in_stock', 'status', 'order', 'view', 'qid', 'price', 'discount_price', 'discount','average_price', 'recommended_price', 'created_at', 'updated_at'], 'integer'],
            [[ 'length', 'width', 'height', 'weight', 'purchase_price'], 'number'],
            [['data'], 'string'],
//            [['created_at', 'updated_at'], 'required'],
            [['sku', 'serial_number'], 'string', 'max' => 150],
            [['slug', 'title', 'image'], 'string', 'max' => 255],
            [['external_id'], 'string', 'max' => 100],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['producer_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProducer::className(), 'targetAttribute' => ['producer_id' => 'id']],
            [['type_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreTypeCar::className(), 'targetAttribute' => ['type_car_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'car_id' => 'Car ID',
            'type_id' => 'Type ID',
            'producer_id' => 'Producer ID',
            'category_id' => 'Category ID',
            'type_car_id' => 'Type Car ID',
            'user_id' => 'User ID',
            'sku' => 'Sku',
            'serial_number' => 'Serial Number',
            'slug' => 'Slug',
            'price' => 'Price',
            'discount_price' => 'Discount Price',
            'discount' => 'Discount',
            'data' => 'Data',
            'is_special' => 'Is Special',
            'length' => 'Length',
            'width' => 'Width',
            'height' => 'Height',
            'weight' => 'Weight',
            'quantity' => 'Quantity',
            'in_stock' => 'In Stock',
            'status' => 'Status',
            'title' => 'Title',
            'image' => 'Image',
            'average_price' => 'Average Price',
            'purchase_price' => 'Purchase Price',
            'recommended_price' => 'Recommended Price',
            'order' => 'Order',
            'external_id' => 'External ID',
            'view' => 'View',
            'qid' => 'Qid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    public static function find() {
        return parent::find()->with('translate','car','category','user');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStatistics()
    {
        return $this->hasMany(ProductStatistic::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrderProducts()
    {
        return $this->hasMany(StoreOrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductAttributeValues()
    {
        return $this->hasMany(StoreProductAttributeValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductAttributes()
    {
        return $this->hasMany(StoreProductAttribute::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductCommissions()
    {
        return $this->hasMany(StoreProductCommission::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImage()
    {
        return $this->hasOne(StoreProductImage::className(), ['product_id' => 'id'])->where(['main' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstImage()
    {
        return $this->hasOne(StoreProductImage::className(), ['product_id' => 'id'])->limit(1);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(StoreProductImage::className(), ['product_id' => 'id'])->where(['main' => 0])->offset(1)->limit('');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductImages()
    {
        return $this->hasMany(StoreProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductLinks()
    {
        return $this->hasMany(StoreProductLink::className(), ['linked_product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductLinks0()
    {
        return $this->hasMany(StoreProductLink::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductToCars()
    {
        return $this->hasMany(StoreProductToCar::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductToCategories()
    {
        return $this->hasMany(StoreProductToCategory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductTranslations()
    {
        return $this->hasMany(StoreProductTranslation::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductTypeOfCarValues()
    {
        return $this->hasMany(StoreProductTypeCarValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductVariants()
    {
        return $this->hasMany(StoreProductVariant::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductVideo()
    {
        return $this->hasMany(StoreProductVideo::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(StoreCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducer()
    {
        return $this->hasOne(StoreProducer::className(), ['id' => 'producer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeCar()
    {
        return $this->hasOne(StoreTypeCar::className(), ['id' => 'type_car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(StoreType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTranslate() {
        return ($this->hasOne(StoreProductTranslation::className(), ['product_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(StoreProductTranslation::className(), ['product_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(StoreProductTranslation::className(), ['product_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
