<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreProduct;

/**
 * StoreProductSearch represents the model behind the search form of `common\models\StoreProduct`.
 */
class StoreProductSearch extends StoreProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'producer_id', 'category_id', 'type_car_id', 'user_id', 'is_special', 'quantity', 'in_stock', 'status', 'order', 'view', 'qid', 'created_at', 'updated_at'], 'integer'],
            [['sku', 'serial_number', 'slug', 'data', 'title', 'image', 'external_id'], 'safe'],
            [['price', 'discount_price', 'discount', 'length', 'width', 'height', 'weight', 'average_price', 'purchase_price', 'recommended_price'], 'number'],
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
        $query = StoreProduct::find();

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
            'type_id' => $this->type_id,
            'producer_id' => $this->producer_id,
            'category_id' => $this->category_id,
            'type_car_id' => $this->type_car_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'discount' => $this->discount,
            'is_special' => $this->is_special,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'weight' => $this->weight,
            'quantity' => $this->quantity,
            'in_stock' => $this->in_stock,
            'status' => $this->status,
            'average_price' => $this->average_price,
            'purchase_price' => $this->purchase_price,
            'recommended_price' => $this->recommended_price,
            'order' => $this->order,
            'view' => $this->view,
            'qid' => $this->qid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'external_id', $this->external_id]);

        return $dataProvider;
    }
}
