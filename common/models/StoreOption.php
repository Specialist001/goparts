<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_options".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property StoreOptionValue[] $storeOptionValues
 */
class StoreOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
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
            'status' => 'Status',
        ];
    }

    public static function find()
    {
        return parent::find()->with('storeOptionValues');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOptionValues()
    {
        return $this->hasMany(StoreOptionValue::className(), ['option_id' => 'id']);
    }
}
