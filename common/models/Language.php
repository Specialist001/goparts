<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $url
 * @property string $locale
 * @property string $name
 * @property int $default
 * @property int $order
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'locale', 'name', 'created_at', 'updated_at'], 'required'],
            [['default', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 100],
            [['locale', 'name'], 'string', 'max' => 255],
            [['locale'], 'unique'],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'locale' => 'Locale',
            'name' => 'Name',
            'default' => 'Default',
            'order' => 'Order',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    //Переменная, для хранения текущего объекта языка
    static $current = null;

    static function getCurrent()
    {
        if( self::$current === null ){
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    //Установка текущего объекта языка и локаль пользователя
    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->locale;
    }

    //Получения объекта языка по умолчанию
    static function getDefaultLang()
    {
        return Language::find()->where('`default` = :default', [':default' => 1])->one();
    }

    //Получения объекта языка по буквенному идентификатору
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Language::find()->where('`url` = :url AND `status` = :status', [':url' => $url, ':status' => 1])->one();
            if ( $language === null ) {
                return null;
            }else{
                return $language;
            }
        }
    }
}
