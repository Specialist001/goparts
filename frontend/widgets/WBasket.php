<?php

namespace frontend\widgets;
use common\models\Category;
use common\models\Language;
use common\models\StoreCategory;
use common\models\UserCart;
use common\models\UserCommission;
use Yii;
use yii\bootstrap\Widget;

class WBasket extends Widget
{
    public $key;
    public $tab;
    public function init(){}

    public function run() {
        if($this->key == 'main') {
            if (Yii::$app->user->id) {
                $userCart = UserCart::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->all();
                $total_price = 0;

                $user_commission = (!empty(UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one())) ? UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one() : 35;
                $commission = $user_commission->commission;
                $commission = (1 + ($commission ? : 0) / 100);

                if ($userCart) {
                    foreach ($userCart as $basket) {
                        $total_price += $basket->product->price * $commission * $basket->count;
                    }
                }
                return  number_format($total_price, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
            } else {
                $userCart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
                $total_price = 0;
                $commission = 35;
                if ($userCart) {
                    foreach ($userCart as $basket) {
                        $total_price += $basket->product->price * $commission * $basket->count;
                    }
                }

                return  number_format($total_price, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
            }
        }

    }
}