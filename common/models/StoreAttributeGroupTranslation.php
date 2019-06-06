<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attribute_group_translations".
 *
 * @property int $id
 * @property int $attribute_group_id
 * @property string $locale
 * @property string $name
 *
 * @property StoreAttributeGroup $attributeGroup
 */
class StoreAttributeGroupTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attribute_group_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_group_id'], 'integer'],
            [['locale', 'name'], 'string', 'max' => 255],
            [['attribute_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttributeGroup::className(), 'targetAttribute' => ['attribute_group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_group_id' => 'Attribute Group ID',
            'locale' => 'Locale',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeGroup()
    {
        return $this->hasOne(StoreAttributeGroup::className(), ['id' => 'attribute_group_id']);
    }
}
