<?php


namespace api\controllers;

use api\transformers\ProfileProductList;
use common\models\StoreProduct;
use common\models\User;
use api\models\ProfileForm;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    public $enableCsrfValidation = false;
    public $enableSession = false;

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => HttpBasicAuth::className(),
                'auth' => function ($email, $password) {
                    $user = User::findByEmail($email);
                    if (!$user) return null;
                    $check = $user->validatePassword($password);
                    return $check ? $user : null;
                }
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'purchase-delete' => ['post'],
//                ],
//            ],
        ];
    }

    public function actionInfo()
    {
        return $this->asJson([
            'id' => Yii::$app->user->identity->id,
//            'name' => Yii::$app->user->identity->name,
            'username' => Yii::$app->user->identity->username,
            'email' => Yii::$app->user->identity->email,
            'avatar' => Yii::$app->user->identity->avatar ? Yii::$app->user->identity->avatar : '/uploads/site/default_avatar.png',
            'phone' => Yii::$app->user->identity->phone,
//            'push' => Yii::$app->user->identity->push,
            'first_name' => Yii::$app->user->identity->first_name,
            'middle_name' => Yii::$app->user->identity->middle_name,
            'last_name' => Yii::$app->user->identity->last_name,
            'gender' => Yii::$app->user->identity->gender == 0 ? 'Male' : 'Female',
            'role' => Yii::$app->user->identity->role == 0 ? 'Buyer' : 'Seller',
            'type' => Yii::$app->user->identity->type == 0 ? 'Individual' : 'Legal entry',
            'birth_date' => Yii::$app->user->identity->birth_date,
        ]);
    }

    public function actionUpdate()
    {
        $model = new ProfileForm();

        $model->username = Yii::$app->request->post('username', Yii::$app->user->identity->username);
        $model->email = Yii::$app->request->post('name', Yii::$app->user->identity->email);
//        $model->phone = Yii::$app->request->post('phone', Yii::$app->user->identity->phone);
        $model->password = Yii::$app->request->post('password');
        $model->passwordconfirm = Yii::$app->request->post('password_confirm');
        $model->first_name = Yii::$app->request->post('first_namr', Yii::$app->user->identity->first_name);
        $model->last_name = Yii::$app->request->post('last_name', Yii::$app->user->identity->last_name);
        $model->location = Yii::$app->request->post('location', Yii::$app->user->identity->location);
        $model->phone = Yii::$app->request->post('phone', Yii::$app->user->identity->phone);

//        $model->push = Yii::$app->request->post('push', 0);
        $model->img = UploadedFile::getInstanceByName('avatar');


        if (!$model->validate()) {
            Yii::$app->getResponse()->setStatusCode(422);
            return $this->asJson($model->errors);
        }

        if ($user = $model->updateProfile()) {
            return $this->asJson([
                'id' => $user->id,
//                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'location' => $user->location,
                'avatar' => $user->avatar ? $user->avatar : '/uploads/site/default_shop.png',
                'phone' => $user->phone,
//                'push' => $user->push,
//                'balance' => $user->balance,
//                'birth_date' => $user->birth_date,
//                'city_id' => (int) $user->city_id,
//                'ucard' => $user->ucard,
            ]);
        }

        return null;
    }

    public function actionProducts($id = null, $category_id = null)
    {
        if ($id) {
            $product = StoreProduct::find()->where(['id' => $id, 'user_id' => Yii::$app->user->identity->id])->all();
            return $this->asJson([
                'data' => ProfileProductList::transform($product),
            ]);
        } else {
            if ($category_id) {
                $products = StoreProduct::find()->where(['category_id' => $category_id, 'user_id' => Yii::$app->user->identity->id])->all();
                return $this->asJson([
                    'data' => ProfileProductList::transform($products),
                ]);
            } else {
                $products = StoreProduct::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
                return $this->asJson([
                    'data' => ProfileProductList::transform($products),
                ]);
            }
        }
    }

    public function actionSetDevice()
    {
        $device_id = Yii::$app->request->post('device_id');

        $user = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();

        if ($user) {
            if ($device_id) {
                $user->device_id = $device_id;
                $user->save();
            } else {
                return $this->asJson(['error' => true, 'message' => 'Device ID is empty']);
            }
        }
        return $this->asJson(['error' => true, 'message' => 'User not found']);
    }
}