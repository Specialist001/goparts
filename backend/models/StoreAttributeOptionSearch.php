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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attribute_id', 'order'], 'integer'],
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
        $query = StoreAttributeOption::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'attribute_id' => $this->attribute_id,
            'order' => $this->order,
        ]);

        return $dataProvider;
    }
}
