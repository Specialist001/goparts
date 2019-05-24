<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_type_of_car_translations".
 *
 * @property int $id
 * @property int $type_car_id
 * @property string $locale
 * @property string $name
 *
 * @property StoreTypeCar $typeCar
 */
class StoreTypeCarTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_type_of_car_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_car_id'], 'required'],
            [['type_car_id'], 'integer'],
            [['locale', 'name'], 'string', 'max' => 255],
            [['type_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreTypeCar::className(), 'targetAttribute' => ['type_car_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_car_id' => 'Type Car ID',
            'locale' => 'Locale',
            'name' => 'Name',
        ];
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
    public function getLocale()
    {
        return $this->hasOne(Language::className(), ['locale' => 'locale']);
    }
}
