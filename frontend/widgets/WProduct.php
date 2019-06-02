<?php
/**
 * Created by ru.lexcorp.
 * User: lexcorp
 * Date: 18.09.2017
 * Time: 6:08
 */
namespace frontend\widgets;
use common\models\Product;
use common\models\UserRecent;
use Yii;
use yii\bootstrap\Widget;
use yii\db\Expression;

class WProduct extends Widget
{
    public $key;
    public $similar = false;
    public function init(){}

    public function run() {
        $products = $title = false;

        /** --- */
        if($this->key == 'interesting') {
            $products = Product::find()->where(['status' => 1, 'interesting' => 1])->orderBy('interesting_order')->limit(10)->all();
            $title = Yii::t('frontend', 'Interesting');
        }

        if($this->key == 'random') {
            $products = Product::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->limit(9)->all();
        }
        /** --- */

        if($this->key == 'bestsellers') {
            $products = Product::find()->where(['status' => 1])->andWhere("`sale_id` > 0")->andWhere("`price` > 0")->orderBy('`created_at` DESC')->limit(10)->all();
            $title = Yii::t('frontend', 'Bestsellers');

            return $this->render('product/view_blue', [
                'products' => $products,
                'title' => $title
            ]);
        }
        if($this->key == 'new') {
            $products = Product::find()->where(['status' => 1])->orderBy('`created_at` DESC')->limit(15)->all();
            $title = Yii::t('frontend', 'New');
        }
        if($this->key == 'popular') {
            $products = Product::find()->where(['status' => 1])->orderBy('`view` DESC')->limit(6)->all();
            $title = Yii::t('frontend', 'Hits');
        }
        if($this->key == 'similar') {
            $products = Product::find()->where(['status' => 1, 'category_id' => $this->similar['cat_id']])->andWhere('`id` != '.$this->similar['prod_id'])->orderBy(new Expression('rand()'))->limit(5)->all();
            $title = Yii::t('frontend', 'Similar');
        }
        if($this->key == 'recent') {
            if(Yii::$app->user->id) {
                $prod_ids = UserRecent::find()->where(['user_id' => Yii::$app->user->id])->orderBy('`created_at` DESC')->limit(Yii::$app->params['recent_count'])->all();
            }
            elseif(!empty(Yii::$app->session->get('product_fav_ids'))) {
                $ses_prod_ids = array_reverse(Yii::$app->session->get('product_fav_ids'));
                for($i = 0; $i < count($ses_prod_ids); $i++) {
                    $prod_ids[$i] = new \stdClass();
                    $prod_ids[$i]->product_id = $ses_prod_ids[$i];
                }
            }
            if(!empty($prod_ids)) {
                for($i = 0; $i < Yii::$app->params['recent_count']; $i++) {
                    $temp_prod = Product::findOne(['id' => $prod_ids[$i]->product_id, 'status' => 1]);
                    if(!empty($temp_prod)) {
                        if(!$temp_prod->shopIsActive) continue;
                        if($temp_prod->category->status == 0) continue;
                        $temp_parent = $temp_prod->category;
                        while ($temp_parent) {
                            if (!$temp_parent->status) {
                                continue;
                            }
                            if (empty($temp_parent->parent)) break;
                            $temp_parent = $temp_parent->parent;
                        }
                        $products[] = $temp_prod;
                    }
                }
            }
            $title = Yii::t('frontend', 'Recent');
        }
        return $this->render('product/view', [
            'products' => $products,
            'title' => $title
        ]);
    }
}