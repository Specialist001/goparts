<?php
namespace frontend\widgets;

use yii\bootstrap\Widget;

class WMap extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('map/view', [
//            'reviews' => OrderProduct::find()->where('`comment_status` > 0')->orderBy('`created_at` DESC')->limit(8)->all()
        ]);
    }
}