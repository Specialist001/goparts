<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_type_attributes".
 *
 * @property int $id
 * @property int $type_id store_type->id  
 * @property int $attribute_id store_attribute->id  
 *
 * @property StoreAttribute $attribute0
 * @property StoreType $type
 */
class StoreTypeAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_type_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'attribute_id'], 'integer'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'attribute_id' => 'Attribute ID',
        ];
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
    public function getType()
    {
        return $this->hasOne(StoreType::className(), ['id' => 'type_id']);
    }
}
