<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_product_link_types".
 *
 * @property int $id
 * @property string $code
 * @property string $title
 *
 * @property StoreProductLinks[] $storeProductLinks
 */
class StoreProductLinkType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_link_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'title'], 'string', 'max' => 255],
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
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductLinks()
    {
        return $this->hasMany(StoreProductLink::className(), ['type_id' => 'id']);
    }
}
