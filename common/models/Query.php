<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "queries".
 *
 * @property int $id
 * @property int $user_id
 * @property int $approve_manager_id approved manager
 * @property int $update_manager_id update manager
 * @property int $car_id
 * @property int $category_id
 * @property string $vendor
 * @property string $title
 * @property string $description
 * @property string $car
 * @property string $year
 * @property string $modification
 * @property string $fueltype
 * @property string $engine
 * @property string $transmission
 * @property string $drivetype
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $image
 * @property int $status
 * @property int $created_at
 *
 * @property Cars $car0
 * @property StoreCategory $category
 * @property User $approveManager
 * @property User $updateManager
 * @property User $user
 * @property QueryImage[] $queryImages
 */
class Query extends \yii\db\ActiveRecord
{
    const STATUS_MODERATED = 0;
    const STATUS_VERIFIED = 1;
    const STATUS_PURCHASED = 2;
    const STATUS_DELETED = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%queries}}';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'approve_manager_id', 'update_manager_id', 'car_id', 'category_id', 'status', 'created_at'], 'integer'],
            [['email'], 'required'],
            [['title'], 'string', 'max' => 150],
            [['vendor', 'car', 'year', 'modification', 'fueltype', 'engine', 'transmission', 'drivetype', 'description', 'name', 'phone', 'email', 'image'], 'string', 'max' => 255],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['approve_manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['approve_manager_id' => 'id']],
            [['update_manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['update_manager_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'approve_manager_id' => 'Approved Manager ID',
            'update_manager_id' => 'Update Manager ID',
            'car_id' => 'Car ID',
            'title' => 'Title',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'vendor' => 'Vendor',
            'car' => 'Car',
            'year' => 'Year',
            'modification' => 'Modification',
            'fueltype' => 'Fueltype',
            'engine' => 'Engine CC',
            'transmission' => 'Transmission',
            'drivetype' => 'Drivetype',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'E-mail',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' =>[
                'class' =>
                    TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ]
//            'createdAtAttribute' => 'created_at',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(StoreCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveManager()
    {
        return $this->hasOne(User::className(), ['id' => 'approve_manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateManager()
    {
        return $this->hasOne(User::className(), ['id' => 'update_manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueryImages()
    {
        return $this->hasMany(QueryImage::className(), ['query_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImage()
    {
        return $this->hasOne(QueryImage::className(), ['query_id' => 'id'])->where(['main' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstImage()
    {
        return $this->hasOne(QueryImage::className(), ['query_id' => 'id'])->limit(1);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(QueryImage::className(), ['query_id' => 'id'])->where(['main' => 0])->offset(1)->limit('');
    }

    public function getSellerQueries()
    {
        return $this->hasMany(SellerQuery::className(), ['query_id' => 'id']);
    }

    public function getSellerProducts()
    {
        return $this->hasMany(SellerQuery::className(), ['query_id' => 'id'])->where(['IS NOT', 'product_id', null]);
    }
}
