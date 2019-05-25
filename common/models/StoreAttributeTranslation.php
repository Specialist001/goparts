<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_attribute_translations".
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $locale
 * @property string $title
 * @property string $description
 *
 * @property StoreAttribute $attribute0
 */
class StoreAttributeTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_attribute_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id'], 'integer'],
            [['description'], 'string'],
            [['locale', 'title'], 'string', 'max' => 255],
            //[['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
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
            'locale' => 'Locale',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(StoreAttribute::className(), ['id' => 'attribute_id']);
    }
}
