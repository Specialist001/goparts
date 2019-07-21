<?php
namespace frontend\controllers;

use common\models\City;
use common\models\SellerQuery;
use common\models\StoreOrder;
use common\models\StoreOrderProduct;
use common\models\StoreProduct;
use common\models\User;
use common\models\UserCart;
use common\models\UserCommission;
use frontend\models\OrderSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{

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

//    public function actionIndex()
//    {
//        $searchModel = new OrderSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMake()
    {
        $data = Yii::$app->request->post();
        $products = $data['CartProduct'];
        $city = City::find()->where(['id' => $data['City']])->one();
        $user = $data['User'];
        $delivery = $data['Delivery'];
//        $city = $data['Location'];
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

                        $user_commission = new UserCommission();
                        $user_commission->id = $user->id;
                        $user_commission->commission = 35;
                        $user_commission->save();

                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'signUp-html', 'text' => 'signUp-text'],
                                ['user' => $user, 'password' => $password]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                            ->setTo($user->email)
                            ->setSubject('Registration on ' . Yii::$app->params['appName'])
                            ->send();
                    }
                }
            }
            else {
                $user = User::findOne(Yii::$app->user->id);
            }

            $user->phone = $user->phone ? $user->phone : $data['User']['phone'];

            if(empty($user)) return $this->redirect(['cart/index']);

            $order = new StoreOrder();
            $order->user_id = $user->id;
            $order->delivery_id = null;
            $order->status = StoreOrder::STATUS_NEW;
            $order->paid = StoreOrder::NOT_PAID;
            $order->total_price = $totalCount;
            $order->name = $data['User']['username'] ? $data['User']['username'] : $user->username;
            $order->email = $data['User']['email'] ? $data['User']['email'] : $user->email;
            $order->phone = $data['User']['phone'] ? $data['User']['phone'] : $user->phone;
//            $order->comment = $data['User']['comment'] ? $data['User']['comment'] : null;
            $order->city = $data['Location'] ? $data['Location'] : $city->name.' ('. $data['Stock'].')';

            if($order->save()) {
                Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'makeOrder-html', 'text' => 'makeOrder-text'],
                        ['type' => 'buyer']
                    )
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                    ->setTo($data['User']['email'])
                    ->setSubject(Yii::$app->params['appName'])
                    ->send();
                Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'makeOrder-html', 'text' => 'makeOrder-text'],
                        ['type' => 'seller']
                    )
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject(Yii::$app->params['appName'])
                    ->send();

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
                    if($sellerQuery->save()) {

                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'buyProduct-html', 'text' => 'buyProduct-text'],
                                [
                                    'type' => 'seller',
                                    'seller_name' => $sellerQuery->seller->username,
                                    'product_name' => $sellerQuery->query->vendor.' '.$sellerQuery->query->car.' '.$sellerQuery->query->modification.' '.$sellerQuery->query->year.' ('.$sellerQuery->product->translate->description.') ',
                                    'product_price' => $sellerQuery->product->price,
                                    'sale_date' => date('m/d/Y', $sellerQuery->updated_at),
                                ]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                            ->setTo($sellerQuery->seller->email)
                            ->setSubject('Your product sold on ' . Yii::$app->name)
                            ->send();

                        $store_product = StoreProduct::find()->where(['id'=>$product['product_id']])->one();
                        $store_product->status = 0;
                        $store_product->save();
                    }
                }
                if(Yii::$app->user->id) {
                    UserCart::deleteAll(['user_id' => Yii::$app->user->id]);
                }
            } else {
//                print_r($order->getFirstErrors());
                return $this->redirect(['cart/index']);
            }
            return $this->redirect(['user/purchases']);
        }
        return $this->redirect(['cart/index']);
    }

    private function checkUser($user) {
        if(strlen($user['username']) < 2) return false;
        if(!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
}