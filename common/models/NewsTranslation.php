<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_translations".
 *
 * @property int $id
 * @property int $news_id
 * @property string $locale
 * @property string $title
 * @property string $slug
 * @property string $short_text
 * @property string $full_text
 * @property string $keywords
 * @property string $description
 *
 * @property News $news
 */
class NewsTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id'], 'integer'],
            [['short_text', 'full_text'], 'string'],
            [['locale', 'title', 'slug', 'keywords', 'description'], 'string', 'max' => 255],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'locale' => 'Locale',
            'title' => 'Title',
            'slug' => 'Slug',
            'short_text' => 'Short Text',
            'full_text' => 'Full Text',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }
}
