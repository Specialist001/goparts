<?php
namespace frontend\controllers;


use common\models\StoreCategory;
use common\models\StoreProduct;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $products = StoreProduct::find()->where(['user_id'=>Yii::$app->user->getId()])->orderBy('order')->with('storeProductToCars')->all();

            return $this->render('product',[
                'products' => $products,
            ]);
        }

        return $this->goBack();
    }

    public function actionCreate()
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $model = new StoreProduct();

            $category = !empty(Yii::$app->request->get('category'))? Yii::$app->request->get('category'): false;

            if(empty($category = StoreCategory::findOne(['id' => $category, 'status' => 1]))) $category = false;
            if(!empty($category)) if(!empty($category->activeCategories))  $category = false;
            $unset = false;
            $temp_parent = $category;
            while ($temp_parent) {
                if (!$temp_parent->status) {
                    $unset = true;
                    break;
                }
                if (empty($temp_parent->parent)) break;
                $temp_parent = $temp_parent->parent;
            }

            if ($unset) $category = false;

            $cats = StoreCategory::find()->where(['parent_id' => null, 'status'=>1])->orderBy('`order`')->all();

            return $this->render('create',[
                'model' => $model,
                'cats' => $cats,
                'category' => $category,
            ]);
        }

        return $this->goBack();
    }
}