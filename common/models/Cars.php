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

    public function getCars()
    {
        $cars = self::find()->all();

        $data = [];
        if (!empty($cars)) {
            if (count($cars)) {
                foreach ($cars as $key=>$car) {
                    $data[$car['car']] = $car['car'];
                }
            }
        }

        return $data;
    }

    public function getCar($vendor)
    {
        $cars = self::find()->where(['vendor'=>$vendor])->all();

        $data = [];
        if (!empty($cars)) {
            if (count($cars)) {
                foreach ($cars as $key=>$car) {
                    $data[$car['car']] = $car['car'];
                }
            }
        }

        return $data;
    }

    public function getModifications($vendor, $car)
    {
        $cars = self::find()->where(['vendor'=>$vendor,'car'=>$car])->orderBy(['modification'=>SORT_ASC, 'year'=>SORT_DESC])->all();
        $cars_array = [];
        $years = [];
        $min_max = [];

        $data = [];
        if (!empty($cars)) {

            if (count($cars)) {
                foreach ($cars as $key => $car_1) {
                    $cars_array[$car_1['modification']] = $car_1['modification'];
                    $years[$car_1['modification']] = self::getYear($vendor, $car, $car_1['modification']);

                    $min_max[$car_1['modification']] =  [
                        'min'=>$min = min($years[$car_1['modification']]),
                        'max'=>$max = max($years[$car_1['modification']])
                    ];
                }
            }

//            if (count($min_max)) {
//                foreach ($min_max as $key => $car_array) {
//                    $data .= '<option value="' . $key . '">' . $key .' ('. $car_array['min'].' - '.$car_array['max'] .')' . '</option>';
//                }
//            }

            $data = $min_max;
        }

        return $data;
    }

    public function getYear($vendor, $car, $modification)
    {
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->orderBy(['year'=>SORT_ASC])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['year']] = $car['year'];
            }
        }

        return $cars_array;
    }

    public function getOneCar($vendor, $car, $modification, $year)
    {
        $oneCar = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification, 'year'=>$year])->one();

        return $oneCar;
    }

    public function getCarName($id)
    {
        $car = Cars::findOne(['id'=>$id]);
//        var_dump($car);
        return $car->vendor . ' ' . $car->car .' '. $car->modification .' '.$car->year;
    }
}
