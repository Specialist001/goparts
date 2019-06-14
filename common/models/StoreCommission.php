<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_commissions".
 *
 * @property int $id
 * @property string $name
 * @property int $commission
 */
class StoreCommission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_commissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'commission'], 'required'],
            [['commission'], 'integer'],
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
            'commission' => 'Commission',
        ];
    }
}
