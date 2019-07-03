<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "query_images".
 *
 * @property int $id
 * @property int $query_id
 * @property int $main
 * @property string $name
 *
 * @property Query $query
 */
class QueryImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'query_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['query_id','main'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['query_id'], 'exist', 'skipOnError' => true, 'targetClass' => Query::className(), 'targetAttribute' => ['query_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'query_id' => 'Query ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuery()
    {
        return $this->hasOne(Query::className(), ['id' => 'query_id']);
    }
}
