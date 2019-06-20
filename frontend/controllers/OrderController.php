<?php
namespace frontend\controllers;

use common\models\SellerQuery;
use common\models\StoreOrder;
use common\models\StoreOrderProduct;
use common\models\User;
use common\models\UserCart;
use Yii;
use yii\web\Controller;

class OrderController extends Controller
{
    const STATUS_NEW = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    const PAID = 1;
    const NOT_PAID = 0;

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

    public function actionMake()
    {
        $data = Yii::$app->request->post();

        $products = $data['CartProduct'];
        $user = $data['User'];
        $delivery = $data['Delivery'];
        $totalCount = $data['TotalCount'];

        if(!empty($data['User'])) {
            if(!$this->checkUser($data['User'])) return $this->redirect(['cart/index']);
            if(!Yii::$app->user->id) {
                if(empty($user = User::findByUsername($data['User']['username']))) {
                    $password = mt_rand(10000000, 99999999);
                    $user = new User();
                    $user->username = $data['User']['username']; //$this->username;
                    $user->email = $data['User']['email'];
                    $user->phone = $data['User']['phone'];
                    $user->status = User::STATUS_INACTIVE;
                    $user->setPassword($password);
                    $user->generateAuthKey();
                    if($user->save()) {
                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'signUp-html', 'text' => 'signUp-text'],
                                ['user' => $user, 'password' => $password]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                            ->setTo($user->email)
                            ->setSubject('Registration on ' . Yii::$app->name)
                            ->send();
                    }
                }
            }
            else {
                $user = User::findOne(Yii::$app->user->id);
            }
            $user->phone = $user->phone ? $user->phone : $data['User']['phone'];
            $user->save();
            if(empty($user)) return $this->redirect(['cart/index']);



            $order = new StoreOrder();
            $order->user_id = Yii::$app->user->identity->getId();
            $order->delivery_id = !empty($delivery) ? $delivery : null;
            $order->status = self::STATUS_NEW;
            $order->paid = self::NOT_PAID;
            $order->total_price = $totalCount;
            $order->name = $data['User']['username'];
            $order->email = $data['User']['email'];
            $order->phone = $data['User']['phone'];
            $order->comment = $data['User']['comment'];
            $order->ip = Yii::$app->getRequest()->getUserIP();
            $order->save();

            foreach ($products as $product) {
                $orderProduct = new StoreOrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product['product_id'];
                $orderProduct->product_name = $product['name'];
                $orderProduct->price = $product['price'];
                $orderProduct->quantity = $product['count'];
                $orderProduct->sku = $product['sku'];
                $orderProduct->save();

                $sellerQuery = SellerQuery::find()->where(['product_id'=>$orderProduct->product_id])->one();
                $sellerQuery->status = SellerQuery::STATUS_PURCHASED;
                $sellerQuery->save();
//                echo '<pre>';
//                print_r($orderProduct);
//                echo '</pre>';
            }

            if(Yii::$app->user->id) {
                UserCart::deleteAll(['user_id' => Yii::$app->user->id]);
            }

            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'makeOrder-html', 'text' => 'makeOrder-text'],
                    ['type' => 'buyer']
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($data['User']['email'])
                ->setSubject(Yii::$app->name)
                ->send();
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'makeOrder-html', 'text' => 'makeOrder-text'],
                    ['type' => 'seller']
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject(Yii::$app->name)
                ->send();

            return $this->redirect(['user/purchases']);

        }
        return $this->redirect(['cart/index']);
//        echo '<pre>';
//        print_r($products);
//        echo '</pre>';
//        return $this->asJson($array);
    }

    private function checkUser($user) {
        if(strlen($user['username']) < 2) return false;
        if(!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
}