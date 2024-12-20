<?php

namespace frontend\controllers;

use common\models\City;
use common\models\Query;
use common\models\SellerQuery;
use common\models\Stock;
use common\models\StoreDelivery;
use common\models\StoreProduct;
use common\models\User;
use common\models\UserCart;
use common\models\UserCommission;
use frontend\widgets\WBasket;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CartController extends \yii\web\Controller
{
    const STATUS_WAIT = 0;
    const STATUS_SEND = 1;
    const STATUS_CANCEL = -1;
    const STATUS_ACCEPTED = 2;

//    public function beforeAction($action)
//    {
//        $this->enableCsrfValidation = false;
//        return parent::beforeAction('delete','clear');
//    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['index', 'signup', 'add'],
//                'rules' => [
//                    [
//                        'actions' => ['index', 'add'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['index', 'add'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    public function actionIndex()
    {
        $total_count = [];
        $userCart = [];
        $deliveries = StoreDelivery::find()->all();
        $cities = City::find()->where(['status'=>1])->all();
        $user_commission = (!empty(UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one())) ? UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one() : 35;
        $commission = $user_commission->commission;
        $commission = (1 + ($commission ? : 0) / 100);

        if (Yii::$app->user->id) {
            $userCart = UserCart::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->all();
        } elseif (!empty(Yii::$app->session->get('cart'))) {
            $products = Yii::$app->session->get('cart');
            $cart_count = Yii::$app->session->get('cart_count', []);
            foreach ($products as $it =>  $product) {
                $userCart_temp = new UserCart();
                $userCart_temp->product_id = $product['product_id'];
                $userCart_temp->count = isset($cart_count[$it]['count'])? $cart_count[$it]['count']: 1;
                $userCart[] = $userCart_temp;
            }
        }
        if (!empty($userCart)) {
            for ($i = 0; $i < count($userCart); $i++) {
                $temp_prod = StoreProduct::findOne(['status' => 1, 'id' => $userCart[$i]->product_id]);
                if (empty($temp_prod)) continue;
            }
        }
        if (!empty($userCart)) {
            $total_count = WBasket::widget(['key'=>'main']);

            return $this->render('index',[
                'cart_products' => $userCart,
                'total_count' => $total_count,
                'deliveries' => $deliveries,
                'cities' => $cities,
                'commission' => $commission,
            ]);
        } elseif(empty($userCart)) {
            return $this->render('index',[
                'cart_products' => $userCart,
                'total_count' => $total_count,
                'cities' => $cities,
                'deliveries' => $deliveries,
                'commission' => 35,
            ]);
        }

    }

    public function actionAdd()
    {
        if (!empty($prod_id = Yii::$app->request->post('product_id'))) {
            $product = StoreProduct::findOne($prod_id);
            $query = SellerQuery::find()->where(['product_id'=> $prod_id])->one();
            if($query) {
                $user_id = $query->query->user_id;
            }

            if (empty($product)) return $this->asJson(['error' => true]);
            if (Yii::$app->user->id) {
                if (empty(UserCart::findOne(['product_id' => $prod_id, 'user_id' => Yii::$app->user->id]))) {
                    $userCart = new UserCart();
                    $userCart->product_id = $prod_id;
                    $userCart->count = (Yii::$app->request->post('count') > 0)? Yii::$app->request->post('count'): 1;
                    $userCart->user_id = Yii::$app->user->id;
                    $userCart->status = self::STATUS_WAIT;
                    if($userCart->save()) $error = 'false';
                    else $error = 'Not Saved';
                    $total_count = WBasket::widget(['key'=>'main']);

                    return json_encode([
                        'error' => $error,
                        'product' => [
                            'page_title' => Yii::t('frontend', 'Product added to cart'),
                            'id' => $product->id,
                            'img' => $product->image,
                            'name' => $product->translate->name,
    //                        'shop' => $product->shop->name,
                            'cat' => $product->category->translate->title,
                            'cart_count' => static::getCount(),
                        ],
                        'total_count' => $total_count,
                    ]);

                } else {
                    return json_encode([
                        'error' => false,
                        'product' => [
                            'page_title' => Yii::t('frontend', 'Product issets in cart'),
                            'img' => $product->image,
                            'id' => $product->id,
                            'name' => $product->translate->name,
    //                        'shop' => $product->shop->name,
                            'cat' => $product->category->translate->title,
                            'cart_count' => static::getCount(),
                        ],
                    ]);
                }
            } else {
                $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
                if (isset($cart)) { if (in_array(['product_id' => $prod_id], $cart)) {

                    return json_encode([
                        'error' => false,
                        'product' => [
                            'page_title' => Yii::t('frontend', 'Product issets in cart'),
                            'img' => $product->image,
                            'id' => $product->id,
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
                    $total_count = WBasket::widget(['key'=>'main']);

                    return json_encode([
                        'error' => false,
                            'product' => [
                            'page_title' => Yii::t('frontend', 'Product added to cart 1'),
                            'img' => $product->image,
                            'name' => $product->translate->name,
    //                        'shop' => $product->shop->name,
                            'cat' => $product->category->translate->title,
                            'cart_count' => static::getCount(),
                            'total_count' => $total_count,
                        ],
                    ]);
            }
        }
        return json_encode(['error' => true]);
    }

    public function actionBuyNow()
    {
        if (!empty($prod_id = Yii::$app->request->post('product_id'))) {
            $product = StoreProduct::findOne($prod_id);
            if (empty($product)) return $this->asJson(['error' => true]);
            if (Yii::$app->user->id) {
                if (empty(UserCart::findOne(['product_id' => $prod_id, 'user_id' => Yii::$app->user->id]))) {
                    $userCart = new UserCart();
                    $userCart->product_id = $prod_id;
                    $userCart->count = (Yii::$app->request->post('count') > 0)? Yii::$app->request->post('count'): 1;
                    $userCart->user_id = Yii::$app->user->id;
                    $userCart->status = self::STATUS_WAIT;
                    if($userCart->save()) $error = 'false';
                    else $error = 'Not Saved';
                    $total_count = WBasket::widget(['key'=>'main']);

                    return $this->redirect(['/cart']);
//                    return json_encode([
//                        'error' => $error,
//                        'product' => [
//                            'page_title' => Yii::t('frontend', 'Product added to cart'),
//                            'img' => $product->image,
//                            'name' => $product->translate->name,
//                            //                        'shop' => $product->shop->name,
//                            'cat' => $product->category->translate->title,
//                            'cart_count' => static::getCount(),
//                        ],
//                        'total_count' => $total_count,
//                    ]);

                } else {
//                    return json_encode([
//                        'error' => false,
//                        'product' => [
//                            'page_title' => Yii::t('frontend', 'Product issets in cart'),
//                            'img' => $product->image,
//                            'name' => $product->translate->name,
//                            //                        'shop' => $product->shop->name,
//                            'cat' => $product->category->translate->title,
//                            'cart_count' => static::getCount(),
//                        ],
//                    ]);

                    return $this->redirect(['/cart']);
                }
            } else {
                $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
                if (isset($cart)) { if (in_array(['product_id' => $prod_id], $cart)) {
                    return $this->redirect(['/cart']);

//                    return json_encode([
//                        'error' => false,
//                        'product' => [
//                            'page_title' => Yii::t('frontend', 'Product issets in cart'),
//                            'img' => $product->image,
//                            'name' => $product->translate->name,
////                                'shop' => $product->shop->name,
//                            'cat' => $product->category->translate->title,
//                            'cart_count' => static::getCount(),
//                        ],
//                    ]);
                }
                }
                $index = count($cart);
                $cart[$index]['product_id'] = $prod_id;
                $cart_count[$index]['count'] = (Yii::$app->request->post('count') > 0)? Yii::$app->request->post('count'): 1;
                Yii::$app->session->set('cart', $cart);
                Yii::$app->session->set('cart_count', $cart_count);
                $total_count = WBasket::widget(['key'=>'main']);

//                return json_encode([
//                    'error' => false,
//                    'product' => [
//                        'page_title' => Yii::t('frontend', 'Product added to cart 1'),
//                        'img' => $product->image,
//                        'name' => $product->translate->name,
//                        //                        'shop' => $product->shop->name,
//                        'cat' => $product->category->translate->title,
//                        'cart_count' => static::getCount(),
//                        'total_count' => $total_count,
//                    ],
//                ]);

                return $this->redirect(['/cart']);
            }
        }
        return json_encode(['error' => true]);
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

    public function actionRecount()
    {
        if (Yii::$app->user->identity->getId()) {
            $products = Yii::$app->request->post('CartProduct');
            $data = [];
            $data_1 = [];
            $t_count = 0;
            $counter = 0;
            foreach ($products as $key => $product) {
                $data_1[$key] = $product['price'] * $product['count'];
                $data[$counter] = [
                    'id' => $key,
                    'sum' => number_format( $product['price'] * $product['count'], Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep'])
                ];
                $counter++;
                $t_count += $data_1[$key];
            }
            $t_count_uf = $t_count;
            $t_count = number_format($t_count, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);


            return json_encode([
                'products'=>$data,
                't_count'=>$t_count,
                't_count_uf'=>$t_count_uf,
            ]);
        }
        return json_encode(['error'=>'error']);
    }

    public function actionDelete()
    {
        if (!empty($data = Yii::$app->request->post('product'))) {
            $data = explode('_', $data);
            if (!isset($data[0])) return json_encode(['error' => true]);
            if (empty($data[0])) return json_encode(['error' => true]);

            $product['product_id'] = $data[0];

            if ($user_id = Yii::$app->user->id) {
                $product['user_id'] = $user_id;
                if(!empty($cart = UserCart::findOne(['id'=>$product['product_id']]))) {
                    if ($cart->delete()) $error = 'false';
                    else $error = 'Dont delete';
                } else {
                    $error = 'Product not found in Cart';
                }
                return json_encode([
                    'error' => $error,
                    'data'=>$product,
                    'cart_count' => static::getCount()]);
            } else {
                $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
                if (!empty($cart)) {
                    if (($key = array_search($product, $cart)) !== false) unset($cart[$key]);
                }
                Yii::$app->session->set('cart', array_values($cart));
                return json_encode(['error' => false, 'cart_count' => static::getCount()]);
            }
        }
        return json_encode(['error' => true]);
    }

    public function actionClear()
    {
        if (Yii::$app->user->identity->getId()) {
            if($cart = UserCart::findAll(['user_id'=>Yii::$app->user->identity->getId()])) {
                if (UserCart::deleteAll(['user_id'=>Yii::$app->user->identity->getId()])) $error = 'false';
                else $error = 'Dont delete';
            } else {
                $error = 'Product not found in Cart';
            }
            return json_encode([
                'error' => $error
            ]);
        }
        else {
            $cart = !empty(Yii::$app->session->get('cart')) ? Yii::$app->session->get('cart') : [];
            if (!empty($cart)) {
                if (($key = array_search($product, $cart)) !== false) unset($cart[$key]);
            }
            Yii::$app->session->set('cart', array_values($cart));
            return json_encode(['error' => false]);
        }
    }

    public function actionGetStocks($id)
    {
        $stocks = Stock::find()->where(['city_id' => $id])->all();

        $stock_array = [];

//        if (count($stocks)) {
//            foreach ($stocks as $key => $stock) {
//                $stock_array[$stock['city_id']] = $stock['name'];
//            }
//        }

        $data = '<option value="" disabled selected>' . 'Select Location' . '</option>';
        if (count($stocks)) {
            foreach ($stocks as $key => $stock) {
                $data .= '<option value="' . $stock->name . '">' . $stock->name . '</option>';
            }
        }

        return $this->asJson($data);
    }

}
