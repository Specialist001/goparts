<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Query;

/**
 * QuerySearch represents the model behind the search form of `common\models\Query`.
 */
class QuerySearch extends Query
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'car_id', 'category_id', 'status', 'created_at'], 'integer'],
            [['vendor', 'car', 'year', 'modification', 'fueltype', 'engine', 'transmission', 'drivetype', 'title', 'description', 'name', 'phone', 'email', 'image'], 'safe'],
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
        $query = Query::find();

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
            'user_id' => $this->user_id,
            'car_id' => $this->car_id,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'vendor', $this->vendor])
            ->andFilterWhere(['like', 'car', $this->car])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'modification', $this->modification])
            ->andFilterWhere(['like', 'fueltype', $this->fueltype])
            ->andFilterWhere(['like', 'engine', $this->engine])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'drivetype', $this->drivetype])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
