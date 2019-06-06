<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callbacks".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $time
 * @property string $comment
 * @property int $status
 * @property string $url
 * @property int $created_at
 */
class Callback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callbacks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at'], 'integer'],
            [['url'], 'string'],
            [['created_at'], 'required'],
            [['name', 'phone', 'time', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'time' => 'Time',
            'comment' => 'Comment',
            'status' => 'Status',
            'url' => 'Url',
            'created_at' => 'Created At',
        ];
    }
}
