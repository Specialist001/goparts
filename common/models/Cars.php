<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cars".
 *
 * @property int $id
 * @property string $vendor
 * @property string $car
 * @property string $year
 * @property string $modification
 *
 * @property StoreProductToCar[] $storeProductToCars
 */
class Cars extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor', 'car', 'modification'], 'string', 'max' => 255],
            [['year'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendor' => 'Vendor',
            'car' => 'Car',
            'year' => 'Year',
            'modification' => 'Modification',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getStoreProductToCars()
    {
        return $this->hasMany(StoreProductToCar::className(), ['car_id' => 'id']);
    }

    public function getVendors()
    {
        $vendors = self::find()->all();

        $data = [];
        if (!empty($vendors)) {
            if (count($vendors)) {
                foreach ($vendors as $key=>$vendor) {
                    $data[$vendor['vendor']] = $vendor['vendor'];
                }
            }
        }

        return $data;
    }
}
