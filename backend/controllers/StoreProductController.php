<?php

namespace backend\controllers;

use common\components\Helper;
use common\components\SimpleImage;
use common\models\Cars;
use common\models\StoreCategory;
use common\models\StoreProductCommission;
use common\models\StoreProductToCar;
use common\models\StoreProductTranslation;
use common\models\StoreProductVideo;
use common\models\StoreTypeCar;
use common\models\User;
use Yii;
use common\models\StoreProduct;
use backend\models\StoreProductSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StoreProductController implements the CRUD actions for StoreProduct model.
 */
class StoreProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StoreProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreProduct model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the StoreProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new StoreProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreProduct();
        $video = new StoreProductVideo();
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

        $car_id = !empty(Yii::$app->request->get('car_id')) ? Yii::$app->request->get('car_id') : false;

        if (empty($car_id = Cars::findOne(['id'=>$car_id]))) $car_id = false;
        if(!empty($car_id)) $car_id = false;


        $translation_en = new StoreProductTranslation();
        $translation_ar = new StoreProductTranslation();
        $translation_ru = new StoreProductTranslation();

        $store_product_commission = new StoreProductCommission();

        $cats = StoreCategory::find()->where(['parent_id' => null, 'status'=>1])->orderBy('`order`')->all();
        $users = User::find()->where(['status' => 10])->all();
        $type_cars = StoreTypeCar::find()->where(['parent_id' => null])->all();
        $cars = Cars::find()->all();

        $cat_filter = [];
        $cat_options = [];
        $user_filter = [];
        $type_car_filter = [];
        $cars_array = [];



//        if (!empty($cats)) {
//            foreach ($cats as $cat) {
//                if ($model->id == $cat->id) continue;
//                $cat_filter[$cat->id] = $cat->translate->title;
//                if ($cat->categories) {
//                    $cat_filter = ArrayHelper::merge($cat_filter, self::getCategoryChild($cat->categories, $model));
//                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->categories, $model));
//                }
//            }
//        }

        if (!empty($cats)) {
            //$cat_filter = ArrayHelper::toArray($cats,['id','title']);
            foreach ($cats as $cat) {
                $cat_filter += [$cat->id => $cat->translate->title];
            }
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $user_filter += [$user->id => $user->username];
            }
        }

        if (!empty($type_cars)) {
            foreach ($type_cars as $type_car) {
                //if ($model->id == $cat->id) continue;
                $type_car_filter[$type_car->id] = $type_car->translate->name;
                if ($type_car->typeCars) {
                    $type_car_filter = ArrayHelper::merge($type_car_filter, self::getTypeCarCategoryChild($type_car->typeCars, $type_car));
//                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->typeCars, $model));
                }
            }
        }

//        if (!empty($cars)) {
//            foreach ($cars as $car) {
//                $cars_array += [$car->id => $car->vendor];
//            }
//        }

        $cars_array = Cars::getVendors();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->user_id = Yii::$app->user->getId();

            $dir = (__DIR__) . '/../../uploads/store-products/';
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->image) {
                $path = $model->image->baseName . '.' . $model->image->extension;
                if ($model->image->saveAs($dir . $path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir . $path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                    $image_name = uniqid() . '.' . $model->image->extension;
                    $resizer->save($dir . $image_name);
                    $model->image = '/uploads/store-products/' . $image_name;
                    if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);
                }
            } else $model->image = '/uploads/site/default_cat.png';

            $model->save();

            $model->sku = Yii::$app->user->getId() .'-'. date('dmy') .'-'. $model->id;

            $translation_en->product_id = $model->id;
            $translation_en->name = (Yii::$app->request->post('StoreProductTranslation')['name']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['en'] : '';
            $translation_en->short = (Yii::$app->request->post('StoreProductTranslation')['short']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['en'] : '';
            $translation_en->description = (Yii::$app->request->post('StoreProductTranslation')['description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['en'] : '';
            $translation_en->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] : '';
            $translation_en->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] : '';
            $translation_en->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] : '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->product_id = $model->id;
            $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
            $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
            $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
            $translation_ar->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] : $translation_en->meta_title;
            $translation_ar->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] : $translation_en->meta_description;
            $translation_ar->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] : $translation_en->meta_keywords;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->product_id = $model->id;
            $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
            $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
            $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
            $translation_ru->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] : $translation_en->meta_title;
            $translation_ru->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] : $translation_en->meta_description;
            $translation_ru->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] : $translation_en->meta_keywords;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            $store_product_commission->product_id = $model->id;
            $store_product_commission->commission = Yii::$app->request->post('product_commission');
            $store_product_commission->save();

            $price = $model->price;

            $purchase_price = $price * (1 + ($model->user->commission->commission ? : 0) / 100);
//            $purchase_price = number_format($price, 2, '.', '');

            $model->purchase_price = $purchase_price;

            $car_vendor = Yii::$app->request->post('vendor_name');
//                ? Yii::$app->request->post('vendor_name') : null;
            $car_model = Yii::$app->request->post('car_name');
//                ? Yii::$app->request->post('car_name') : null;
            $car_modification = Yii::$app->request->post('modification_name');
//                ? Yii::$app->request->post('modification_name') : null;
            $car_year = Yii::$app->request->post('year_name');
//                ? Yii::$app->request->post('year_name') : null;

            $car = Cars::find()
                ->where(['vendor'=>$car_vendor, 'car'=>$car_model, 'modification'=>$car_modification, 'year'=>$car_year])->one();

            $productCar = new StoreProductToCar();
            $productCar->product_id = $model->id;
            $productCar->car_id = $car->id;
            $productCar->save();

            $car_name = $car_vendor ? $car_vendor . '-' : null . $car_model ? $car_model . '-' : null . $car_modification ? $car_modification . '-' : null . $car_year ? $car_year . '_' : null;

            if (empty(Yii::$app->request->post('StoreProduct')['title'])) {
                $model->title = Helper::toSlug($translation_en->name) . '_' . $model->id;
            } else {
                $model->title = Helper::toSlug(Yii::$app->request->post('StoreProduct')['title']) . '_' . $model->id;
            }

            if (empty(Yii::$app->request->post('StoreProduct')['slug'])) {
                $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;
            } else {
                $model->slug = Helper::toSlug(Yii::$app->request->post('StoreProduct')['slug']) . '_' . $model->id;
            }

            $model->save();

            return $this->redirect(['update', 'id' => $model->id, 'category' => $model->category_id]);
        }

        $errors = $model->errors;

        return $this->render('create', [
            'model' => $model,
            'video' => $video,
            'cats' => $cats,
            'category' => $category,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
            'cat_filter' => $cat_filter,
            'user_filter' => $user_filter,
            'type_car_filter' => $type_car_filter,
            'cars_array' => $cars_array,
//            'errors' => $errors,
        ]);
    }

    public function getTypeCarCategoryChild($cat, $model, $index = 1)
    {
        $result = [];
        $prefix = '';
        for ($i = 0; $i < $index; $i++) {
            $prefix .= '-';
        }
        $style = false;
        if ($index == 1) $style = 'bold';
        foreach ($cat as $item) {
            if ($model->id == $item->id) continue;
            if ($style) $result[$item->id] = $prefix . $item->translate->name;
            else $result[$item->id] = $prefix . $item->translate->name;
            if ($item->typeCars) {
                $result = ArrayHelper::merge($result, self::getTypeCarCategoryChild($item->typeCars, $type_car, $index + 1));
            }
        }
        return $result;
    }

    /**
     * Updates an existing StoreProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $video = (!empty(StoreProductVideo::find(['product_id' => $model->id])->all())) ? StoreProductVideo::find(['product_id' => $model->id])->all() : new StoreProductVideo();

        $translation_en = StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'en-EN']);
        $translation_ar = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']) : new StoreProductTranslation();
        $translation_ru = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']) : new StoreProductTranslation();

        $store_product_commission = StoreProductCommission::findOne(['product_id' => $model->id]);

        $cats = StoreCategory::find()->where(['parent_id' => null])->all();
        $type_cars = StoreTypeCar::find()->where(['parent_id' => null])->all();

        $cat_filter = [];
        $type_car_filter = [];

        if (!empty($cats)) {
            //$cat_filter = ArrayHelper::toArray($cats,['id','title']);
            foreach ($cats as $cat) {
                $cat_filter += [$cat->id => $cat->translate->title];
            }
        }

//        if (!empty($users)) {
//            foreach ($users as $user) {
//                $user_filter += [$user->id => $user->username];
//            }
//        }

        if (!empty($type_cars)) {
            foreach ($type_cars as $type_car) {
                //if ($model->id == $cat->id) continue;
                $type_car_filter[$type_car->id] = $type_car->translate->name;
                if ($type_car->typeCars) {
                    $type_car_filter = ArrayHelper::merge($type_car_filter, self::getTypeCarCategoryChild($type_car->typeCars, $type_car));
                }
            }
        }

        $cars_array = Cars::getVendors();

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $dir = (__DIR__) . '/../../uploads/store-products/';
            $image = UploadedFile::getInstance($model, 'image');

            if ($image) {
                $path = $image->baseName . '.' . $image->extension;
                if ($image->saveAs($dir . $path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir . $path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                    $image_name = uniqid() . '.' . $image->extension;
                    $resizer->save($dir . $image_name);
                    $model->image = '/uploads/store-products/' . $image_name;
                    if (file_exists($dir . $path)) unlink($dir . $path);
                }
            } else $model->image = $old_image;

            $model->save();

            $translation_en->product_id = $model->id;
            $translation_en->name = (Yii::$app->request->post('StoreProductTranslation')['name']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['en'] : '';
            $translation_en->short = (Yii::$app->request->post('StoreProductTranslation')['short']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['en'] : '';
            $translation_en->description = (Yii::$app->request->post('StoreProductTranslation')['description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['en'] : '';
            $translation_en->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] : '';
            $translation_en->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] : '';
            $translation_en->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] : '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->product_id = $model->id;
            $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
            $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
            $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
            $translation_ar->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] : $translation_en->meta_title;
            $translation_ar->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] : $translation_en->meta_description;
            $translation_ar->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] : $translation_en->meta_keywords;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->product_id = $model->id;
            $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
            $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
            $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
            $translation_ru->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] : $translation_en->meta_title;
            $translation_ru->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] : $translation_en->meta_description;
            $translation_ru->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] : $translation_en->meta_keywords;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            $store_product_commission->product_id = $model->id;
            $store_product_commission->commission = Yii::$app->request->post('product_commission');
            $store_product_commission->save();

            $price = $model->price;
            $purchase_price = $price * (1 + ($model->user->commission->commission ? : 0) / 100);
            $model->purchase_price = $purchase_price;

            $car_vendor = Yii::$app->request->post('vendor_name')
                ? Yii::$app->request->post('vendor_name') : null;
            $car_model = Yii::$app->request->post('car_name')
                ? Yii::$app->request->post('car_name') : null;
            $car_modification = Yii::$app->request->post('modification_name')
                ? Yii::$app->request->post('modification_name') : '*';
            $car_year = Yii::$app->request->post('year_name')
                ? Yii::$app->request->post('year_name') : null;

            $car = Cars::find()->groupBy(['id'])
                ->where(['vendor'=>$car_vendor, 'car'=>$car_model])->min('id');
            $car_2 = Cars::find()->groupBy(['id'])
                ->where(['vendor'=>$car_vendor, 'car'=>$car_model])->max('id');

            $query_cars = (new Query())
                ->select(['min(id)','max(id)'])
                ->from('cars')
                ->where(['vendor'=>$car_vendor])
                ->andWhere(['car'=>$car_model])
                //->andWhere(['modification'=>$car_modification])
                ->all();



            $productCar = new StoreProductToCar();
            $productCar->product_id = $model->id;
            $productCar->car_id = $car->id;
            $productCar->save();

            $car_name = $car_vendor ? $car_vendor . '-' : null . $car_model ? $car_model . '-' : null . $car_modification ? $car_modification . '-' : null . $car_year ? $car_year . '_' : null;

            if (empty(Yii::$app->request->post('StoreProduct')['title'])) {
                $model->title = Helper::toSlug($translation_en->name) . '_' . $model->id;
            } else {
                $model->title = Helper::toSlug(Yii::$app->request->post('StoreProduct')['title']) . '_' . $model->id;
            }
            if (empty($model->slug)) {
                if (empty(Yii::$app->request->post('StoreProduct')['slug'])) {
                    $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;
                } else {
                    $model->slug = Helper::toSlug(Yii::$app->request->post('StoreProduct')['slug']) . '_' . $model->id;
                }
            }

            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        $errors = $model->errors;

        return $this->render('update', [
            'model' => $model,
            'video' => $video,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
            'cat_filter' => $cat_filter,
            'type_car_filter' => $type_car_filter,
            'cars_array' => $cars_array,
            'store_product_commission' => $store_product_commission,
//            'errors' => $errors,
        ]);
    }

    /**
     * Deletes an existing StoreProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function getCategoryChild($cat, $model, $index = 1)
    {
        $result = [];
        $prefix = '';
        for ($i = 0; $i < $index; $i++) {
            $prefix .= '-';
        }
        $style = false;
        if ($index == 1) $style = 'bold';
        foreach ($cat as $item) {
            if ($model->id == $item->id) continue;
            if ($style) $result[$item->id] = $prefix . $item->translate->title;
            else $result[$item->id] = $prefix . $item->translate->title;
            if ($item->categories) {
                $result = ArrayHelper::merge($result, self::getCategoryChild($item->typeCars, $model, $index + 1));
            }
        }
        return $result;
    }

    public function getCategoryOptions($cat, $model, $index = 1)
    {
        $result = [];
        foreach ($cat as $item) {
            if ($model->id == $item->id) continue;
            $result[$item->id] = ['style' => 'font-weight: bold;'];
        }
        return $result;
    }

    public function actionGetPrice($purchase_price, $commission)
    {
        $price = (float)$purchase_price * (1 + ((float)$commission ?: 0) / 100);
        $price = number_format($price, 2, '.', '');

        return $this->asJson($price);
    }

    public function actionGetCar($vendor)
    {
//        if (Yii::$app->request->isAjax) {
//            $car_vendor = Yii::$app->request->post('vendor_name');
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['car']] = $car['car'];
            }
        }

//        $data = '<div class="form-group">';
//        $data .= '<label class="control-label" for="car">Car</label>';
//        $data .= '<select name="car[]" id="car_items" class="form-control car_items">';
        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Car model") . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }
//        $data .= "</select>";
//        $data .= "</div>";

//        echo json_encode(array('data => $data, 'error' => $error));
        return $this->asJson($data);
//        } else {
//            return null;
//        }
    }

    public function actionGetModification($vendor, $car)
    {
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor, 'car' => $car])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car_1) {
                $cars_array[$car_1['modification']] = $car_1['modification'];
            }
        }
        $query_years = (new Query())
            ->select(['min(id)','max(id)'])
            ->from('cars')
            ->where(['vendor'=>$car_vendor])
            ->andWhere(['car'=>$car])
            //->andWhere(['modification'=>$car_modification])
            ->all();

        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Modification") . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }

        return $this->asJson($data);
    }

    public function actionGetYear($vendor, $car, $modification)
    {
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['year']] = $car['year'];
            }
        }

        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Year") . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }

        return $this->asJson($data);
    }


}
