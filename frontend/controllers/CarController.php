<?php
namespace frontend\controllers;

use common\models\Cars;
use common\models\StoreCategory;
use common\models\StoreProduct;
use common\models\StoreTypeCar;
use common\models\User;
use common\models\UserCommission;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CarController extends Controller
{
    public $_user;

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['search', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['product'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                ],
//            ],
//
//        ];
//    }

    public function actionSearch($vendor=null, $car=null, $modification=null, $category_id = null, $type_car_id = null)
    {
        if ($vendor != null) {
//        self::getCar()
            $cars = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->all();
            $categories = StoreCategory::find()->where(['IS','parent_id',null])->all();
            $body_types = StoreTypeCar::find()->where(['IS NOT','parent_id',null])->all();


            if (!empty($car)) {
                if (!empty($modification)) {
                    $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->min('id')
                        ? Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->min('id')
                        : false;
                    $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->max('id')
                        ? Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->max('id')
                        : false;
                    if ($car_id_min!=false && $car_id_max!=false) {
                        $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['status' => 1])->all();
                    }
                } else {
                    $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car' => $car])->min('id')
                        ? Cars::find()->where(['vendor' => $vendor, 'car' => $car])->min('id')
                        : false;
                    $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car' => $car])->max('id')
                        ? Cars::find()->where(['vendor' => $vendor, 'car' => $car])->max('id')
                        : false;
                    if ($car_id_min!=false && $car_id_max!=false) {
                        $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['status' => 1])->all();
                    }
                }
            } else {
                $car_id_min = Cars::find()->where(['vendor' => $vendor])->min('id') ? Cars::find()->where(['vendor' => $vendor])->min('id') : false;
                $car_id_max = Cars::find()->where(['vendor' => $vendor])->max('id') ? Cars::find()->where(['vendor' => $vendor])->max('id') : false;

                if ($car_id_min!=false && $car_id_max!=false) {
                    $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['status' => 1])->all();
                } else {
                    $products = null;
                }
            }

//            $products = StoreProduct::find()->where([])->andWhere(['status' => 1])->all();

            if (!empty($category_id)) {
                $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['category_id' => $category_id])->andWhere(['status' => 1])->all();
            }
            if (!empty($type_car_id)) {
                $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['type_car_id' => $type_car_id])->andWhere(['status' => 1])->all();
            }
            if (!empty($category_id) && !empty($type_car_id)) {
                $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['category_id' => $category_id, 'type_car_id' => $type_car_id])->andWhere(['status' => 1])->all();
            }


            return $this->render('search', [
                'products' => $products,
                'categories' => $categories,
                'body_types' => $body_types,
            ]);
        } else {
           return $this->goBack();
        }
    }

    public function actionProduct($id, $token=null)
    {
        if($token) {
            $email = base64_decode($token);
            if ($this->getUser($email)!= false) {
                //Yii::$app->user->login($this->getUser($email),  3600 * 24 * 30);
                
                Yii::$app->user->switchIdentity($this->getUser($email), 3600 * 24 * 30);
                $session = Yii::$app->session;
		$session->open();
                Yii::$app->user->enableSession = true;
                $session->setTimeout(3600 * 24 * 30);
            }
        }

        $user_commission = (!empty(UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one())) ? UserCommission::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one() : 35;
        $commission = $user_commission->commission;
        $commission = (1 + ($commission ? $commission : 0) / 100);

        return $this->render('product', [
            'product' => $this->findModel($id),
            'commission' => $commission,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds user by [[$email]]
     *
     * @return User|null
     */
    protected function getUser($email)
    {
         return User::findByEmail($email) ? User::findByEmail($email) : false;

    }
}