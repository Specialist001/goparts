<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StoreCategory;

/**
 * StoreCategorySearch represents the model behind the search form of `common\models\Category`.
 */
class StoreCategorySearch extends StoreCategory
{
    public $title;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'status', 'order', 'view', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'title', 'image'], 'safe'],
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
        $query = StoreCategory::find()->
        leftJoin('store_category_translations','store_category_translations.category_id=store_categories.id')->with('translate');
//        leftJoin('store_category_translations','store_category_translations.category_id=store_categories.id AND store_category_translations.locale = "'.\common\models\Language::getCurrent()->getAttribute('locale').'"');

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
        $query->andFilterWhere(['like', 'store_category_translations.title', $this->title]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'order' => $this->order,
            'view' => $this->view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
