<?php
namespace api\controllers;


use api\models\PasswordResetRequestForm;
use api\models\SignupForm;
use common\components\SmsService;
use common\models\Chat;
use common\models\FbToken;
use common\models\Order;
use common\models\OrderProduct;
use common\models\Shop;
use common\models\SiteToken;
use common\models\User;
use common\models\UserAddress;
use frontend\models\AddressForm;
use frontend\models\ProfileForm;
use frontend\models\ReviewForm;
use rmrevin\yii\fontawesome\FA;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class AuthController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionLogin() {
        $username = Yii::$app->request->post('username', null);
        $password = Yii::$app->request->post('password', null);
        $siteToken = Yii::$app->request->post('siteToken', null);

        if (!$username) {
            return $this->redirect(['site/error', 'message' => 'username is required', 'code' => 422]);
        }
        if (!$password) {
            return $this->redirect(['site/error', 'message' => 'password is required', 'code' => 422]);
        }

//        $smsService = new SmsService();
//        if ($this->isPhone($username)) {
//            $username = $smsService->clearPhone($username);
//        }

        $user = User::findByUsername($username);

        if (!$user) {
            return $this->redirect(['site/error', 'message' => Yii::t('frontend', 'User not found.'), 'code' => 401]);
        }

        $check = $user->validatePassword($password);

        if (!$check) {
            return $this->redirect(['site/error', 'message' => Yii::t('frontend', 'Incorrect username or password.'), 'code' => 401]);
        }

        if($siteToken) {
            $siteToken_model = new SiteToken();
            $siteToken_model->user_id = $user->id;
            $siteToken_model->token = $siteToken;
            $siteToken_model->save();
        }

        return $this->asJson(['type' => 'Basic', 'token' => base64_encode($username.':'.$password),'user_status'=>$user->status, 'user_role'=>$user->role]);
//        return $this->asJson([]);
    }

    public function actionRegister(){
        $model = new SignupForm();

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $email = Yii::$app->request->post('email');
        $role = Yii::$app->request->post('role', null);
        $legal_info = Yii::$app->request->post('legal_info', null);
        $location = Yii::$app->request->post('location', null);
//        print_r(Yii::$app->request->post());exit;
        //$name = Yii::$app->request->post('name', null);

        //$smsService = new SmsService();

        if (!$username) {
            return $this->redirect(['site/error', 'message' => 'username is required', 'code' => 422]);
        }
//        if (!$this->isEmail($username)) {
//            return $this->redirect(['site/error', 'message' => 'username is invalid', 'code' => 422]);
//        }
//        if ($this->isPhone($username)) {
//            $username = $smsService->clearPhone($username);
//        }

        $user = User::findByUsername($username);
        if ($user) {
            return $this->redirect(['site/error', 'message' => Yii::t('frontend', 'You are registered already'), 'code' => 401]);
        }

//        if (!$name) {
//            return $this->redirect(['site/error', 'message' => 'name is required', 'code' => 422]);
//        }
//        if (strlen($name) < 2) {
//            return $this->redirect(['site/error', 'message' => 'name should be at least 2 characters', 'code' => 422]);
//        }

        $model->username = $username;
        $model->email = $email;
        $model->role = $role;
        $model->legal_info = $legal_info;
        $model->location = $location;

        //$model->name = $name;
        //$password = mt_rand(100000, 999999);


        if ($user = $model->signup($password)) {
//            $model->sendEmail($password);
            return $this->asJson([
                'type' => 'Basic',
                'token' => base64_encode($user->username.':'.$password),
            ]);
        }

        return $this->redirect(['site/error', 'message' => 'Invalid data send', 'code' => 422]);
    }

    public function actionReset() {
        $model = new PasswordResetRequestForm();

//        $smsService = new SmsService();
        $username = Yii::$app->request->post('username', null);
        if (!$username) {
            return $this->redirect(['site/error', 'message' => 'username is required', 'code' => 422]);
        }
        if (!$this->isEmail($username) && !$this->isPhone($username)) {
            return $this->redirect(['site/error', 'message' => 'username is invalid', 'code' => 422]);
        }
//        if ($this->isPhone($username)) {
//            $username = $smsService->clearPhone($username);
//        }

        $user = User::findByUsername($username);
        if (!$user) {
            return $this->redirect(['site/error', 'message' => Yii::t('frontend', 'There is no user with this email address.'), 'code' => 401]);
        }

        $model->username = $username;

        if ($model->sendEmail()) {
            if($model->isEmail()) {
                return $this->asJson(['message' => Yii::t('frontend', 'Check your email for further instructions.')]);
            } else if($model->isPhone()){
                return $this->asJson(['message' => Yii::t('frontend', 'Password send to your phone')]);
            }
            return $this->redirect(['site/error', 'message' => 'Invalid data send', 'code' => 200]);
        }

        return $this->redirect(['site/error', 'message' => 'Invalid data send', 'code' => 422]);
    }

    public function isEmail($username) {
        return filter_var($username, FILTER_VALIDATE_EMAIL);
    }

//    public function isPhone($username) {
//        $smsService = new SmsService();
//        return $smsService->isUzPhone($smsService->clearPhone($username));
//    }
}