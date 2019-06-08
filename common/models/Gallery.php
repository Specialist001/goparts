<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "galleries".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property int $user_id
 * @property int $preview_id
 * @property int $category_id
 *
 * @property Categories $category
 * @property Images $preview
 * @property User $user
 * @property GalleriesToImages[] $galleriesToImages
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'galleries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status', 'user_id', 'preview_id', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['preview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['preview_id' => 'id']],
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
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'user_id' => 'User ID',
            'preview_id' => 'Preview ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreview()
    {
        return $this->hasOne(Image::className(), ['id' => 'preview_id']);
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
    public function getGalleriesToImages()
    {
        return $this->hasMany(GalleryToImage::className(), ['gallery_id' => 'id']);
    }
}
