<?php
namespace api\models;

use common\components\SimpleImage;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ProfileForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $push;
    public $password;
    public $passwordconfirm;

    public $role; // 0-buyer, 1-seller
    public $type; // 0-Individual, 1-Legal Entity
    public $birth_date;

    public $first_name;
    public $middle_name;
    public $last_name;

    public $site;
    public $about;
    public $location;
    public $avatar;
    public $legal_info;
    public $legal_reg_certificate;
    public $legal_address;
    public $legal_bank_account;
    public $legal_vat_number;

    public $gender; //0-male, 1-female


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['avatar', 'file'],

            [['birth_date'], 'safe'],
            ['birth_date', 'date', 'format' => 'yyyy-M-d'],

            [['role', 'type', 'gender',], 'integer'],
//            ['ucard', 'integer'],
            ['push', 'safe'],
//            ['phone', 'match', 'pattern' => '/^\\d{12}$/i'],
//            ['email', 'trim'],
//            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['phone', 'unique', 'targetClass' => '\common\models\User', 'when' => function($model) {return $model->phone != Yii::$app->getUser()->identity->phone;}],

//            ['password', 'required'],
            [['password'], 'string', 'min' => 6],
            ['passwordconfirm', 'compare', 'compareAttribute'=>'password'],

            [['first_name', 'middle_name', 'last_name', 'site', 'about', 'location', 'phone', 'legal_info', 'legal_reg_certificate', 'legal_address', 'legal_bank_account', 'legal_vat_number',], 'string']
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Username'),
            'phone' => Yii::t('common', 'Phone'),
            'password' => Yii::t('common', 'New password'),
            'passwordconfirm' => Yii::t('common', 'New password confirm'),
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

        $avatar = $this->uploadProfilePicture();


        $user = User::findOne(Yii::$app->user->id);
        $root = realpath(dirname(__FILE__).'/../../');

        $oldFile = $user->avatar;
        if($avatar !== false) {
            if($avatar->saveAs($root.'/uploads/users/'.$this->avatar)) {
                $resizer = new SimpleImage();
                $resizer->load($root.'/uploads/users/'.$this->avatar);
                $resizer->resize(200, 200);
                $image_name = uniqid().'.'.$avatar->extension;
                $resizer->save($root.'/uploads/users/'.$image_name);
                if(is_file($root.'/uploads/users/'.$this->avatar) && file_exists($root.'/uploads/users/'.$this->avatar)) {
                    unlink($root.'/uploads/users/'.$this->avatar);
                }
                $user->avatar = '/uploads/users/'.$image_name;
                if(!empty($oldFile) && file_exists($root.$oldFile)) {
                    unlink($root.$oldFile);
                }
            }
        }

        $user->username = $this->username;
        $user->phone = $this->phone ? $this->phone : $user->phone;
        $user->email = $this->email ? $this->email : $user->email;
        $user->avatar = $this->avatar ? $this->avatar : $user->avatar;
//        $user->role = $this->role ? $this->role : 0;
//        $user->type = $this->type ? $this->type : 0;
//        $user->birth_date = $this->birth_date ? $this->birth_date : null;
//        $user->gender = $this->gender ? $this->gender : 0;

        $user->first_name = $this->first_name ? $this->first_name : $user->first_name;
//        $user->middle_name = $this->middle_name ? $this->middle_name : $user->middle_name;
        $user->last_name = $this->last_name ? $this->last_name : $user->last_name;

//        $user->site = $this->site ? $this->site : $user->site;
        $user->location = $this->site ? $this->site : $user->location;

//
//        $user->push = $this->push;

        if($this->password) {
            $user->setPassword($this->password);
        }
        return $user->save() ? $user : null;
    }

    /**
     * Process upload of profile picture
     *
     * @return mixed the uploaded profile picture instance
     */
    public function uploadProfilePicture() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $avatar = $this->avatar;

        // if no avatar was uploaded abort the upload
        if (empty($avatar)) {
            return false;
        }

        // store the source file name
        //$this->filename = $avatar->name;
        $avatarName = (explode(".", $avatar->name));
        $ext = end($avatarName);

        // generate a unique file name
        $this->avatar = uniqid().".{$ext}";

        // the uploaded profile picture instance
        return $avatar;
    }
}
