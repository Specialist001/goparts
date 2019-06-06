<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "queries".
 *
 * @property int $id
 * @property int $own
 * @property string $vendor
 * @property string $car
 * @property string $year
 * @property string $modification
 * @property string $fueltype
 * @property string $engine
 * @property string $transmission
 * @property string $drivetype
 * @property string $name
 * @property string $image
 * @property int $status
 * @property int $created_at
 *
 * @property QueryImage[] $queryImages
 */
class Query extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['own', 'status', 'created_at'], 'integer'],
            [['created_at'], 'required'],
            [['vendor', 'car', 'year', 'modification', 'fueltype', 'engine', 'transmission', 'drivetype', 'name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'own' => 'Own',
            'vendor' => 'Vendor',
            'car' => 'Car',
            'year' => 'Year',
            'modification' => 'Modification',
            'fueltype' => 'Fueltype',
            'engine' => 'Engine',
            'transmission' => 'Transmission',
            'drivetype' => 'Drivetype',
            'name' => 'Name',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueryImages()
    {
        return $this->hasMany(QueryImage::className(), ['query_id' => 'id']);
    }
}
