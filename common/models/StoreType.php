<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property StoreProductAttribute[] $storeProductAttributes
 * @property StoreProduct[] $storeProducts
 * @property StoreTypeAttribute[] $storeTypeAttributes
 */
class StoreType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductAttributes()
    {
        return $this->hasMany(StoreProductAttribute::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreTypeAttributes()
    {
        return $this->hasMany(StoreTypeAttribute::className(), ['type_id' => 'id']);
    }

    public function getStoreTypeAttribute()
    {
        return$this->hasOne(StoreTypeAttribute::className(), ['type_id' => 'id'])->with('attribute0');
    }
}
