<?php

namespace frontend\controllers;

use app\models\UserCart;
use common\models\StoreProduct;
use Yii;

class CartController extends \yii\web\Controller
{
    const STATUS_WAIT = 0;
    const STATUS_SEND = 1;
    const STATUS_CANCEL = -1;
    const STATUS_ACCEPTED = 2;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        if (!empty($prod_id = Yii::$app->request->post('product_id'))) {
            $product = StoreProduct::findOne($prod_id);
            if (empty($product)) return $this->asJson(['error' => true]);
            if (Yii::$app->user->id) {
                if (empty(UserCart::findOne(['product_id' => $prod_id, 'user_id' => Yii::$app->user->id, 'order_id' => NULL]))) {
                    $userCart = new UserCart();
                    $userCart->product_id = $prod_id;
                    $userCart->count = (Yii::$app->request->post('count') > 0)? Yii::$app->request->post('count'): 1;
                    $userCart->user_id = Yii::$app->user->id;
                    $userCart->status = self::STATUS_WAIT;
                    $userCart->save();
                    return $this->asJson([
                        'error' => false,
                        'product' => [
                            'page_title' => Yii::t('frontend', 'Product added to cart'),
                            'img' => $product->image,
                            'name' => $product->translate->name,
    //                        'shop' => $product->shop->name,
                            'cat' => $product->category->translate->title,
                            'cart_count' => static::getCount(),
                        ],
                    ]);

                } else {
                    return $this->asJson([
                        'error' => false,
                        'product' => [
                            'page_title' => Yii::t('frontend', 'Product issets in cart'),
                            'img' => $product->image,
                            'name' => $product->translate->name,
    //                        'shop' => $product->shop->name,
                            'cat' => $product->category->translate->title,
                            'cart_count' => static::getCount(),
                        ],
                    ]);
                }
            } else {
                $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
                if (isset($cart)) {
                    if (in_array(['product_id' => $prod_id], $cart)) {
                        return $this->asJson([
                            'error' => false,
                            'product' => [
                                'page_title' => Yii::t('frontend', 'Product issets in cart'),
                                'img' => $product->image,
                                'name' => $product->translate->name,
//                                'shop' => $product->shop->name,
                                'cat' => $product->category->translate->title,
                                'cart_count' => static::getCount(),
                            ],
                        ]);
                    }
                }
                $index = count($cart);
                $cart[$index]['product_id'] = $prod_id;
                $cart_count[$index]['count'] = (Yii::$app->request->post('count') > 0)? Yii::$app->request->post('count'): 1;
                Yii::$app->session->set('cart', $cart);
                Yii::$app->session->set('cart_count', $cart_count);

                return $this->asJson([
                    'error' => false,
                        'product' => [
                        'page_title' => Yii::t('frontend', 'Product added to cart'),
                        'img' => $product->image,
                        'name' => $product->translate->name,
//                        'shop' => $product->shop->name,
                        'cat' => $product->category->translate->title,
                        'cart_count' => static::getCount(),
                    ],
                ]);
            }
        }
        return $this->asJson(['error' => true]);
    }

    public static function getCount() {
        if (Yii::$app->user->id) {
            $count =  UserCart::find()->where(['user_id' => Yii::$app->user->id])->count();
        }
        else{
            $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
            $count =  (!empty($cart))? count($cart): 0;
        }
        return ($count > 9)? '9+': $count;
    }

}
