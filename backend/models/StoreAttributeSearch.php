<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreAttribute;

/**
 * StoreAttributeSearch represents the model behind the search form of `common\models\StoreAttribute`.
 */
class StoreAttributeSearch extends StoreAttribute
{
    public $title;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'type', 'required', 'order', 'is_filter'], 'integer'],
            [['name', 'unit', 'title'], 'safe'],
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
        $query = StoreAttribute::find()->leftJoin('store_attribute_translations','store_attribute_translations.attribute_id=store_attributes.id AND store_attribute_translations.locale = "'.\common\models\Language::getCurrent()->getAttribute('locale').'"');

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

        $query->andFilterWhere(['like', 'store_attribute_translations.title', $this->title]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'type' => $this->type,
            'required' => $this->required,
            'order' => $this->order,
            'is_filter' => $this->is_filter,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }
}
