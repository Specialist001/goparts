<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mail_events".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 *
 * @property MailTemplate[] $mailTemplates
 */
class MailEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mail_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['code'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailTemplates()
    {
        return $this->hasMany(MailTemplate::className(), ['event_id' => 'id']);
    }
}
