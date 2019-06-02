<?php

namespace frontend\widgets;
use common\models\Product;
use common\models\Category;
use Yii;
use yii\bootstrap\Widget;
use yii\db\Expression;

class WAverage extends Widget
{
    public $key;
    public $average_amount;
    //public $category_id = 22;

    public function init(){}

    public function run()
    {
        $category_array = [];
        $cat_array = [];

        $categories = self::getCategories();
        $product_model = new Product();
        if($this->key == 'average') {
            foreach($categories as $category) {
                $products = $product_model->find()->where(['category_id' => $category->id, 'status' => 1]);
                if ($products->count() == 0) continue;
                $products_count = $products->count();
                $products = $products->all();

                $counter_prod = 0;
                $product_sum = 0;
                foreach ($products as $product) {
                    $wholesales = json_decode($product->wholesale);
                    if (!empty($wholesales)) {
                        foreach ($wholesales as $ws_count => $sum) {
                            $product_sum = $sum + $product_sum;
                        }
                        $counter_prod++;
                    }
                }


                $average = round($product_sum/$counter_prod, 0);
                $average_price = (preg_match('/\./i', $average))? number_format($average, Yii::$app->params['price_dec']['decimals'], Yii::$app->params['price_dec']['dec_pointer'], Yii::$app->params['price_dec']['thousands_sep']): number_format($average, Yii::$app->params['price']['decimals'], Yii::$app->params['price']['dec_pointer'], Yii::$app->params['price']['thousands_sep']);
                $average_price = preg_replace('/,00$/i', '', $average_price);

                $cat_array[] = [
                    'id' => $category->id,
                    'name' => $category->translate->name,
                    'url' => $category->url,
                    'sum' => $average_price . ' ' . Yii::t('frontend', 'Currency') . '/' . $product->unit->name
                ];

            }
            $category_array = $cat_array;
        }

        return $this->render('average/view', [
            'category_array' => $category_array,
        ]);
    }

    public function getCategories()
    {
        $categories = Category::find()->where(['status' => 1])
            ->andWhere(['!=', 'parent_id', 25])
            ->andWhere(['!=', 'parent_id', ''])
            ->all();

        return $categories;
    }
}
