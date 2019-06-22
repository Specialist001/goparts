<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreOrder;

/**
 * StoreOrderSearch represents the model behind the search form of `common\models\StoreOrder`.
 */
class StoreOrderSearch extends StoreOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'delivery_id', 'manager_id', 'payment_method_id', 'status', 'paid', 'payment_time', 'separate_delivery', 'created_at', 'updated_at'], 'integer'],
            [['delivery_price', 'total_price', 'discount', 'coupon_discount'], 'number'],
            [['payment_details', 'name', 'street', 'phone', 'email', 'comment', 'ip', 'url', 'note', 'zipcode', 'country', 'city', 'house', 'apartment'], 'safe'],
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
        $query = StoreOrder::find();

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
            'delivery_id' => $this->delivery_id,
            'manager_id' => $this->manager_id,
            'delivery_price' => $this->delivery_price,
            'payment_method_id' => $this->payment_method_id,
            'status' => $this->status,
            'paid' => $this->paid,
            'payment_time' => $this->payment_time,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'coupon_discount' => $this->coupon_discount,
            'separate_delivery' => $this->separate_delivery,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_details', $this->payment_details])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'house', $this->house])
            ->andFilterWhere(['like', 'apartment', $this->apartment]);

        return $dataProvider;
    }
}
