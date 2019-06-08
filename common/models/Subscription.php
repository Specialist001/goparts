<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $email
 * @property string $vendor
 * @property string $car
 * @property int $year
 * @property string $modification
 * @property int $created_at
 *
 * @property User $user
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'year', 'created_at'], 'integer'],
            [['created_at'], 'required'],
            [['email', 'vendor', 'car', 'modification'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'category_id' => 'Category ID',
            'email' => 'Email',
            'vendor' => 'Vendor',
            'car' => 'Car',
            'year' => 'Year',
            'modification' => 'Modification',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
