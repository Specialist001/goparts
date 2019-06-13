<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ProfileForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $passwordconfirm;
    public $legal_info;
    public $legal_address;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['phone', 'string', 'min' => 13, 'max' => 13],
            ['phone', 'match', 'pattern' => '/^\+\d{12}$/i'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['legal_info','legal_address'],'string'],

            ['phone', 'unique', 'targetClass' => '\common\models\User', 'when' => function($model) {return $model->phone != Yii::$app->getUser()->identity->phone;}],

//            ['password', 'required'],
            [['password'], 'string', 'min' => 6],
            ['passwordconfirm', 'compare', 'compareAttribute'=>'password'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Name'),
            'phone' => Yii::t('frontend', 'Phone'),
            'email' => 'E-mail',
            'legal_address' => 'Legal Address',
            'legal_info' => 'Name of Company',
            'password' => Yii::t('frontend', 'New password'),
            'passwordconfirm' => Yii::t('frontend', 'New password confirm'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function updateProfile()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = User::findOne(Yii::$app->user->id);
        $user->username = $this->username; //$this->username;
        $user->email = $this->email;
        $user->phone = $this->phone? $this->phone: null; //$this->username;
        $user->legal_info = $this->legal_info; //$this->username;
        $user->legal_address = $this->legal_address; //$this->username;
        if($this->password) {
            $user->setPassword($this->password);
        }
        return $user->save() ? $user : null;
    }
}
