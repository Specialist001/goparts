<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attribute_option_translations".
 *
 * @property int $id
 * @property int $attribute_option_id
 * @property string $locale
 * @property string $value
 *
 * @property StoreAttributeOption $attributeOption
 */
class StoreAttributeOptionTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attribute_option_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_option_id'], 'integer'],
            [['locale', 'value'], 'string', 'max' => 255],
            [['attribute_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttributeOption::className(), 'targetAttribute' => ['attribute_option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_option_id' => 'Attribute Option ID',
            'locale' => 'Locale',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeOption()
    {
        return $this->hasOne(StoreAttributeOption::className(), ['id' => 'attribute_option_id']);
    }
}
