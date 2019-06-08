<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $blog_id
 * @property int $category_id
 * @property int $create_user_id
 * @property int $update_user_id
 * @property string $slug
 * @property string $quote
 * @property string $link
 * @property string $create_user_ip
 * @property int $access_type
 * @property string $image
 * @property int $status
 * @property int $comment_status
 * @property int $created_at
 * @property int $updated_at
 * @property int $published_at
 *
 * @property PostToTags[] $postToTags
 * @property PostTranslation[] $postTranslations
 * @property Blog $blog
 * @property Category $category
 * @property User $createUser
 * @property User $updateUser
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id', 'category_id', 'create_user_id', 'update_user_id', 'access_type', 'status', 'comment_status', 'created_at', 'updated_at', 'published_at'], 'integer'],
            [['quote'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['slug'], 'string', 'max' => 160],
            [['link', 'image'], 'string', 'max' => 255],
            [['create_user_ip'], 'string', 'max' => 30],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_user_id' => 'id']],
            [['update_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['update_user_id' => 'id']],
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
            'category_id' => 'Category ID',
            'create_user_id' => 'Create User ID',
            'update_user_id' => 'Update User ID',
            'slug' => 'Slug',
            'quote' => 'Quote',
            'link' => 'Link',
            'create_user_ip' => 'Create User Ip',
            'access_type' => 'Access Type',
            'image' => 'Image',
            'status' => 'Status',
            'comment_status' => 'Comment Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToTags()
    {
        return $this->hasMany(PostToTag::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTranslations()
    {
        return $this->hasMany(PostTranslation::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
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
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'update_user_id']);
    }
}
