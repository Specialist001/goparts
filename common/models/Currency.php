<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string $alpha_code
 * @property string $short
 * @property string $symbol
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property StorePayments[] $storePayments
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['alpha_code'], 'string', 'max' => 4],
            [['short', 'symbol'], 'string', 'max' => 100],
            [['alpha_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alpha_code' => 'Alpha Code',
            'short' => 'Short',
            'symbol' => 'Symbol',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorePayments()
    {
        return $this->hasMany(StorePayments::className(), ['currency_id' => 'id']);
    }
}
