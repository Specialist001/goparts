<?php

namespace api\controllers;

use api\transformers\StoreCategoryList;
use common\components\SimpleImage;
use common\models\Cars;
use common\models\Query;
use common\models\StoreCategory;
use common\models\User;
use frontend\models\QuerySearch;
use Yii;
use yii\base\ErrorException;
use yii\web\UploadedFile;

class QueryController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new QuerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->identity->role == User::ROLE_BUYER || Yii::$app->user->isGuest) {

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->goBack();
    }

    public function actionCreate()
    {
        if (Yii::$app->user->identity->role == User::ROLE_BUYER && Yii::$app->user->identity->status == User::STATUS_ACTIVE || Yii::$app->user->isGuest) {
            $model = new Query();
            $category = !empty(Yii::$app->request->get('category'))? Yii::$app->request->get('category'): false;

            $car = Cars::findOne(['id'=>Yii::$app->request->get('car_id')]);
            $car_id = $car->id;

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

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->user_id = Yii::$app->user->id ? Yii::$app->user->id : null;
                //$model->car_id = $car_id;
                //$model->category_id = $category;
                $model->save();

                $dir = (__DIR__) . '/../../uploads/queries/';
                $model->image = UploadedFile::getInstance($model, 'image');

                if ($model->image) {
                    $path = $model->image->baseName . '.' . $model->image->extension;
                    if ($model->image->saveAs($dir . $path)) {
                        $resizer = new SimpleImage();
                        $resizer->load($dir . $path);
                        $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                        $image_name = uniqid() . '.' . $model->image->extension;
                        $resizer->save($dir . $image_name);
                        $model->image = '/uploads/queries/' . $image_name;
                        if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);
                    }
                } else $model->image = '';

                $model->save();
//                if (!$model->save()){
//
//                return $this->redirect(['site/error', 'message' => 'Not saved', 'code' => 404]);
//                }
                return $this->asJson(['data'=>$model,'query_status'=>'Added']);
//                return $this->asJson(['model'=>$model]);
            }
            return $this->redirect(['site/error', 'message' => 'Not validate', 'code' => 404]);
        }
        return $this->redirect(['site/error', 'message' => 'You have not permission for add request', 'code' => 404]);
    }

//    public function actionCategory($id = null)
//    {
//        $category = null;
//        if ($id) {
//            $category = StoreCategory::find()->where(['status' => 1, 'id' => $id])->orderBy('order')->all();
//        } else {
//            $category = StoreCategory::find()->where(['status' => 1, 'parent_id' => null])->orderBy('order')->all();
//        }
//        if ($category) {
//            return $this->asJson(['data' => StoreCategoryList::transform($category)]);
//        } else {
//            return $this->redirect(['site/error', 'message' => 'Not Found', 'code' => 404]);
//        }
//
//    }

}
