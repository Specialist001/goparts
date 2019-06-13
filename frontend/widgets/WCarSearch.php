<?php

namespace frontend\widgets;


use common\models\Cars;
use Yii;
use yii\bootstrap\Widget;

class WCarSearch extends Widget
{
    public function init(){}

    public function run() {

        $cars_array = Cars::getVendors();
        $models_array = Cars::getCar(Yii::$app->request->get('vendor')) ? Cars::getCar(Yii::$app->request->get('vendor')) : null;
        $modifications_array =
            Cars::getModifications(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'))
                ? Cars::getModifications(Yii::$app->request->get('vendor'), Yii::$app->request->get('car'))
                : null;

        $mod_array = [];

        if(!empty($modifications_array)){
            foreach ($modifications_array as $key => $mod) {
                $mod_array[$key] = $key. ' ('.$mod['min'].' - '.$mod['max'].')';
            }
        }


        return $this->render('car-search/view', [
            'cars_array' => $cars_array,
            'models_array' => $models_array,
            'mod_array' => $mod_array,
        ]);
    }
}