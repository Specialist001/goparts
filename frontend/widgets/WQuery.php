<?php

namespace frontend\widgets;

use common\models\Cars;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Url;

class WQuery extends Widget
{
    public function init()
    {
    }

    public function run()
    {
        $vendor = Yii::$app->request->post('vendor');
        $car = Yii::$app->request->post('car');
        $modification = Yii::$app->request->post('modification');
        $year = Yii::$app->request->post('year');

        if ($vendor && $car && $modification && $year) {
            $car_id = Cars::find()->where(['vendor'=>$vendor,'car'=>$car,'modification'=>$modification,'year'=>$year])->one();



//            return Url::to(['query/create','car_id'=>$car_id]);
            return Yii::$app->response->redirect(['query/create', 'car_id' => $car_id]);

        } else {
            $cars_array = Cars::getVendors();
            $models_array = Cars::getCar($vendor) ? Cars::getCar($vendor) : null;
            $modifications_array =
                Cars::getModifications($vendor, $car)
                    ? Cars::getModifications($vendor, $car)
                    : null;

            $years_array = Cars::getYear($vendor, $car, $modification)
                ? Cars::getYear($vendor, $car, $modification)
                : null;

            $mod_array = [];

            if (!empty($modifications_array)) {
                foreach ($modifications_array as $key => $mod) {
                    $mod_array[$key] = $key . ' (' . $mod['min'] . ' - ' . $mod['max'] . ')';
                }
            }

            return $this->render('query/view', [
                'cars_array' => $cars_array,
                'models_array' => $models_array,
                'mod_array' => $mod_array,
            ]);
        }



    }
}