<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attribute_groups".
 *
 * @property int $id
 * @property int $order
 * @property string $name
 *
 * @property StoreAttributeGroupTranslation[] $storeAttributeGroupTranslations
 * @property StoreAttributeOption[] $storeAttributeOptions
 * @property StoreAttribute[] $storeAttributes
 */
class StoreAttributeGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attribute_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order'], 'integer'],
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
            'order' => 'Order',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttributeGroupTranslations()
    {
        return $this->hasMany(StoreAttributeGroupTranslation::className(), ['attribute_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttributeOptions()
    {
        return $this->hasMany(StoreAttributeOption::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreAttributes()
    {
        return $this->hasMany(StoreAttribute::className(), ['group_id' => 'id']);
    }
}
