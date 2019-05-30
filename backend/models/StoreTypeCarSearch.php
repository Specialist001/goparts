<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreTypeCar;

/**
 * StoreTypeCarSearch represents the model behind the search form of `common\models\StoreTypeCar`.
 */
class StoreTypeCarSearch extends StoreTypeCar
{
    public $name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'status', 'order'], 'integer'],
            [['external_id', 'slug', 'view', 'image', 'name'], 'safe'],
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
        $query = StoreTypeCar::find()->leftJoin('store_type_of_car_translations','store_type_of_car_translations.type_car_id=store_type_of_cars.id AND store_type_of_car_translations.locale = "'.\common\models\Language::getCurrent()->getAttribute('locale').'"');;

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

        $query->andFilterWhere(['like', 'store_type_of_car_translations.name', $this->name]);


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'external_id', $this->external_id])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
