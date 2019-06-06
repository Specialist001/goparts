<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MenuItem;

/**
 * MenuItemSearch represents the model behind the search form of `common\models\MenuItem`.
 */
class MenuItemSearch extends MenuItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'menu_id', 'regular_link', 'condition_denial', 'order', 'status'], 'integer'],
            [['title', 'href', 'class', 'title_attr', 'before_link', 'after_link', 'target', 'rel', 'condition_name'], 'safe'],
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
        $query = MenuItem::find();

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
            'parent_id' => $this->parent_id,
            'menu_id' => $this->menu_id,
            'regular_link' => $this->regular_link,
            'condition_denial' => $this->condition_denial,
            'order' => $this->order,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'title_attr', $this->title_attr])
            ->andFilterWhere(['like', 'before_link', $this->before_link])
            ->andFilterWhere(['like', 'after_link', $this->after_link])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'rel', $this->rel])
            ->andFilterWhere(['like', 'condition_name', $this->condition_name]);

        return $dataProvider;
    }
}
