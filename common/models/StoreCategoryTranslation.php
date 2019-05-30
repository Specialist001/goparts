<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store_category_translations".
 *
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $title
 * @property string $short
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property StoreCategory $category
 */
class StoreCategoryTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_category_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required' ,'on' => 'create'],
            [['category_id'], 'integer'],
            [['short', 'description', 'meta_keywords'], 'string'],
            [['locale', 'title', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'locale' => 'Locale',
            'title' => 'Title',
            'short' => 'Short',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
        ];
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
    public function getLocale()
    {
        return $this->hasOne(Language::className(), ['locale' => 'locale']);
    }


}
