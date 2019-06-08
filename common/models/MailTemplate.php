<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mail_templates".
 *
 * @property int $id
 * @property int $event_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $from
 * @property string $to
 * @property string $theme
 * @property string $body
 * @property int $status
 *
 * @property MailEvent $event
 */
class MailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mail_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'status'], 'integer'],
            [['description', 'theme', 'body'], 'string'],
            [['code'], 'string', 'max' => 150],
            [['name', 'from', 'to'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => MailEvent::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'from' => 'From',
            'to' => 'To',
            'theme' => 'Theme',
            'body' => 'Body',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(MailEvent::className(), ['id' => 'event_id']);
    }
}
