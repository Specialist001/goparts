<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property int $category_id
 * @property int $create_user_id
 * @property int $update_user_id
 * @property string $icon
 * @property string $slug
 * @property int $type
 * @property int $status
 * @property int $member_status
 * @property int $post_status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogTranslation[] $blogTranslations
 * @property Category $category
 * @property User $createUser
 * @property User $updateUser
 * @property Post[] $posts
 * @property UsersBlog[] $usersBlogs
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'create_user_id', 'update_user_id', 'type', 'status', 'member_status', 'post_status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['icon'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 160],
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
            'category_id' => 'Category ID',
            'create_user_id' => 'Create User ID',
            'update_user_id' => 'Update User ID',
            'icon' => 'Icon',
            'slug' => 'Slug',
            'type' => 'Type',
            'status' => 'Status',
            'member_status' => 'Member Status',
            'post_status' => 'Post Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function find() {
        return parent::find()->with('translate');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTranslations()
    {
        return $this->hasMany(BlogTranslation::className(), ['blog_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['blog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBlogs()
    {
        return $this->hasMany(UsersBlog::className(), ['blog_id' => 'id']);
    }

    public function getTranslate() {
        return ($this->hasOne(BlogTranslation::className(), ['blog_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])->all())
            ? $this->hasOne(BlogTranslation::className(), ['blog_id' => 'id'])->where(['locale' => Language::getCurrent()->locale])
            : $this->hasOne(BlogTranslation::className(), ['blog_id' => 'id'])->where(['locale' => Language::getDefaultLang()->locale]);
    }
}
