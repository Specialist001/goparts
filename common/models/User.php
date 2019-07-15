<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $phone
 * @property integer $role
 * @property string $avatar
 * @property string $legal_info
 * @property string $legal_address
 * @property string $auth_key
 * @property string $reg_type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property UserCommission $commission
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const ROLE_BUYER = 0;
    const ROLE_SELLER = 1;

    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => self::ROLE_BUYER],
            ['role', 'in', 'range' => [self::ROLE_BUYER, self::ROLE_SELLER]],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This login is already taken.', 'on' => 'admin'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email is already taken.', 'on' => 'admin'],
            [['username', 'email'], 'required', 'on' => 'admin'],
            [['password'], 'string', 'min' => 6, 'max' => 16, 'on' => 'admin'],

            [['gender', 'role', 'type', 'access_level', 'visit_time', 'email_confirm', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['birth_date'], 'safe'],
            [['birth_date'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'first_name', 'middle_name', 'last_name', 'site', 'about', 'location', 'legal_info', 'legal_reg_certificate', 'legal_address', 'legal_bank_account', 'legal_vat_number', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['reg_type'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 255],
//            [['phone'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password' => 'Password',
            'email' => 'Email',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'role' => 'Role',
            'type' => 'Type',
            'birth_date' => 'Birth Date',
            'site' => 'Site',
            'about' => 'About',
            'reg_type' => 'Register Type',
            'location' => 'Location',
            'access_level' => 'Access Level',
            'visit_time' => 'Visit Time',
            'avatar' => 'Avatar',
            'email_confirm' => 'Email Confirm',
            'phone' => 'Phone',
            'legal_info' => 'Name of Company',
            'legal_reg_certificate' => 'Legal Reg Certificate',
            'legal_address' => 'Legal Address',
            'legal_bank_account' => 'Legal Bank Account',
            'legal_vat_number' => 'Legal Vat Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['create_user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs0()
    {
        return $this->hasMany(Blog::className(), ['update_user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifySettings()
    {
        return $this->hasMany(NotifySetting::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['change_user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages0()
    {
        return $this->hasMany(Page::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['create_user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['update_user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStatistics()
    {
        return $this->hasMany(ProductStatistic::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrders()
    {
        return $this->hasMany(StoreOrder::className(), ['manager_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreOrders0()
    {
        return $this->hasMany(StoreOrder::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommissions()
    {
        return $this->hasMany(UserCommission::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBlogs()
    {
        return $this->hasMany(UsersBlog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellerCars()
    {
        return $this->hasMany(SellerCar::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommission()
    {
        return $this->hasOne(UserCommission::className(), ['user_id' => 'id']);
    }
}
