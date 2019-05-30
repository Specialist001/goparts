<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreAttributeOption;

/**
 * StoreAttributeOptionSearch represents the model behind the search form of `common\models\StoreAttributeOption`.
 */
class StoreAttributeOptionSearch extends StoreAttributeOption
{
    public $attribute_name;
    public $value;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attribute_id', 'order'], 'integer'],
            [['attribute_name', 'value'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StoreAttributeOption::find()
            ->leftJoin('store_attributes','store_attribute_options.attribute_id=store_attributes.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'store_attributes.name', $this->attribute_name]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'attribute_id' => $this->attribute_id,
            'order' => $this->order,
        ]);

        return $dataProvider;
    }
}
