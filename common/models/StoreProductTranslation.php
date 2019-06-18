<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_translations".
 *
 * @property int $id
 * @property int $product_id
 * @property string $locale
 * @property string $name
 * @property string $short
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_canonical
 *
 * @property StoreProduct $product
 */
class StoreProductTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['description', 'meta_keywords'], 'string'],
            [['locale', 'name', 'short', 'meta_title', 'meta_description', 'meta_canonical'], 'string', 'max' => 255],
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
            'locale' => 'Locale',
            'name' => 'Name',
            'short' => 'Short',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'meta_canonical' => 'Meta Canonical',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['id' => 'product_id']);
    }
}
