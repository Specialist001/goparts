<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sitemaps".
 *
 * @property int $id
 * @property string $url
 * @property string $change_freq
 * @property double $priority
 * @property int $status
 */
class Sitemap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sitemaps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['priority'], 'number'],
            [['status'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['change_freq'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'change_freq' => 'Change Freq',
            'priority' => 'Priority',
            'status' => 'Status',
        ];
    }
}
