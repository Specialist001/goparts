<?php

namespace frontend\widgets;


use common\models\Cars;
use yii\bootstrap\Widget;

class WCarSearch extends Widget
{
    public function init(){}

    public function run() {
//        $cars_array = [];

        $cars_array = Cars::getVendors();
        return $this->render('car-search/view', [
            'cars_array' => $cars_array,
//            'reviews' => OrderProduct::find()->where('`comment_status` > 0')->orderBy('`created_at` DESC')->limit(8)->all()
        ]);
    }
}