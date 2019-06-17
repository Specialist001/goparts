<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_option_values".
 *
 * @property int $id
 * @property int $option_id
 * @property string $value
 *
 * @property StoreOption $option
 */
class StoreOptionValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_option_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreOption::className(), 'targetAttribute' => ['option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Option_id' => 'Option ID',
            'Value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(StoreOption::className(), ['id' => 'option_id']);
    }
}
