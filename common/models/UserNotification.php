<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_notifications".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $priority 1-normal priority, 2-medium priority, 3-high priority
 * @property int $status 0-not read, 1-read
 *
 * @property User $user
 */
class UserNotification extends \yii\db\ActiveRecord
{
    const NORMAL_PRIORITY = 1;
    const MEDIUM_PRIORITY = 2;
    const HIGH_PRIORITY = 3;

    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'priority', 'status'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'description' => 'Description',
            'priority' => 'Priority',
            'status' => 'Status',
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
