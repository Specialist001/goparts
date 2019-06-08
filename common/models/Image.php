<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $file
 * @property int $order
 * @property int $type
 * @property int $status
 * @property int $created_at
 *
 * @property Gallery[] $galleries
 * @property GalleryToImage[] $galleriesToImages
 * @property Category $category
 * @property Image $parent
 * @property Image[] $images
 * @property User $user
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_id', 'category_id', 'order', 'type', 'status', 'created_at'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'required'],
            [['name', 'file'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => 'Parent ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'file' => 'File',
            'order' => 'Order',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleriesToImages()
    {
        return $this->hasMany(GalleryToImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Image::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
