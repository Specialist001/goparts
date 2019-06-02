<?php
namespace frontend\widgets;

use common\models\Product;
use yii\bootstrap\Widget;

class WLatestowl extends Widget
{
    public function init(){}

    public function run()
    {
        $products = Product::find()->where(['status' => 1])->orderBy('`created_at` DESC')->limit(10)->all();

        return $this->render('latestowl/view', [
            'products' => $products,
        ]);
    }
}