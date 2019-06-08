<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_translations".
 *
 * @property int $id
 * @property int $blog_id
 * @property string $name
 * @property string $description
 * @property string $locale
 *
 * @property Blog $blog
 */
class BlogTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'locale'], 'string', 'max' => 255],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_id' => 'Blog ID',
            'name' => 'Name',
            'description' => 'Description',
            'locale' => 'Locale',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }
}
