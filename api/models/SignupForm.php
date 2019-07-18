<?php
namespace api\models;

use common\models\StoreCommission;
use common\models\UserCommission;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $legal_info;
    public $location;
    public $phone;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

//            ['role', 'string', 'max' => 255],
//            ['legal_info', 'string', 'max' => 255],
//            ['location', 'string', 'max' => 255],
//            ['phone', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($password)
    {
//        if (!$this->validate()) {
//            return null;
//        }
        
        $user = new User();
        $user_commission = new UserCommission();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role = $this->role;
        $user->legal_info = $this->legal_info;
        $user->location = $this->location;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
//        echo 'true';
        if($user->save()){
            $user_commission->user_id = $user->id;
            if ($user->role == 1) {
                $user_commission->commission = 0;
            } else {
                $store_commission = StoreCommission::findOne(['name'=>'manual']);
                $user_commission->commission = $store_commission ? $store_commission->commission : 25;
            }
            $user_commission->save();

//            $auth = Yii::$app->authManager;
//            $role = $auth->getRole('user');
//            $auth->assign($role, $user->id);
            self::sendEmail($user);
            self::sendEmailAdmin($user);

            return $user;
        }

        return null;
//        return $user->save() ? $user : null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return
            Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->params['appName'])
            ->send();
    }

    protected function sendEmailAdmin($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerifyAdmin-html', 'text' => 'emailVerifyAdmin-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Account registration at ' . Yii::$app->params['appName'])
            ->send();
    }
}
