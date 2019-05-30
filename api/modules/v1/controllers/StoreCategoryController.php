<?php

namespace api\modules\v1\controllers;

use backend\models\StoreCategorySearch;
use common\models\StoreCategory;
use Yii;
use yii\rest\ActiveController;

/**
 * StoreCategory Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class StoreCategoryController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\StoreCategory';

    public function actionIndex()
    {
        $searchModel = new StoreCategorySearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = StoreCategory::find()->all();

        $parents = StoreCategory::find()->select('parent_id')->orderBy('parent_id')->groupBy('parent_id')->all();

        $parent_filter = [];
        if(!empty($parents)) {
            foreach ($parents as $parent) {
                if($parent->parent_id != '') $parent_filter[$parent->parent->id] = $parent->parent->translate->title;
            }
        }

//        return $this->render('index', [
//            'searchModel' => $searchModel,
////            'dataProvider' => $dataProvider,
//            'parent_filter' => $parent_filter,
//        ]);

        return $this->asJson($categories);
    }

    public function actionUsers()
    {

    }
}

