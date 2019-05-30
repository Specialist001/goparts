<?php

namespace backend\controllers;

use common\components\Helper;
use common\components\SimpleImage;
use common\models\StoreTypeCarTranslation;
use Yii;
use common\models\StoreTypeCar;
use backend\models\StoreTypeCarSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StoreTypeCarController implements the CRUD actions for StoreTypeCar model.
 */
class StoreTypeCarController extends Controller
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
     * Lists all StoreTypeCar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreTypeCarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $parents = StoreTypeCar::find()->select('parent_id')->orderBy('parent_id')->groupBy('parent_id')->all();

        $parent_filter = [];
        if(!empty($parents)) {
            foreach ($parents as $parent) {
                if($parent->parent_id != '') $parent_filter[$parent->parent->id] = $parent->parent->translate->name;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent_filter' => $parent_filter,
        ]);
    }

    /**
     * Displays a single StoreTypeCar model.
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
     * Creates a new StoreTypeCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreTypeCar();

        $translation_en = new StoreTypeCarTranslation();
        $translation_ar = new StoreTypeCarTranslation();
        $translation_ru = new StoreTypeCarTranslation();

        if ($model->id > 0) {
            $cats = StoreTypeCar::find()->where(['parent_id' => null])->andWhere('`id` != ' . $model->id)->all();
        } else $cats = StoreTypeCar::find()->where(['parent_id' => null])->all();

        $cat_filter[] = 'No parent';
        $cat_options = [];
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                if ($model->id == $cat->id) continue;
                $cat_filter[$cat->id] = $cat->translate->name;
                if ($cat->typeCars) {
                    $cat_filter = ArrayHelper::merge($cat_filter, self::getCategoryChild($cat->typeCars, $model));
                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->typeCars, $model));
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->parent_id = ($model->parent_id > 0)? $model->parent_id: null;
            $model->slug = '_'.uniqid();

            $dir = (__DIR__).'/../../uploads/store-type-cars/';
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->image){
                $path = $model->image->baseName.'.'.$model->image->extension;
                if($model->image->saveAs($dir.$path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir.$path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-type-car']['image'][0], Yii::$app->params['imageSizes']['store-type-car']['image'][1]);
                    $image_name = uniqid().'.'.$model->image->extension;
                    $resizer->save($dir.$image_name);
                    $model->image = '/uploads/store-type-cars/'.$image_name;
                    if(is_file($dir.$path)) if(file_exists($dir.$path)) unlink($dir.$path);
                }
            } else $model->image = '/uploads/store-type-cars/default_type.png';

            $model->save();

            $translation_en->type_car_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['en'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['en']: '';
            $translation_en->save();

            $translation_ar->type_car_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['ar'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['ar']: $translation_en->name;
            $translation_ar->save();

            $translation_ru->type_car_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['ru'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['ru']: $translation_en->name;
            $translation_ru->save();

            if (empty(Yii::$app->request->post('StoreTypeCar')['slug'])) {
                $model->slug = Helper::toSlug($translation_en->name).'_'.$model->id;
            } else {
                $model->slug = Helper::toSlug(Yii::$app->request->post('StoreTypeCar')['slug']) . '_'.$model->id;
            }
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
            'cat_filter' => $cat_filter,
            'cat_options' => $cat_options,
        ]);
    }

    /**
     * Updates an existing StoreTypeCar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $translation_en = new StoreTypeCarTranslation();
        $translation_ar = new StoreTypeCarTranslation();
        $translation_ru = new StoreTypeCarTranslation();

        if ($model->id > 0) {
            $cats = StoreTypeCar::find()->where(['parent_id' => null])->andWhere('`id` != ' . $model->id)->all();
        } else $cats = StoreTypeCar::find()->where(['parent_id' => null])->all();

        $cat_filter[] = 'No parent';
        $cat_options = [];
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                if ($model->id == $cat->id) continue;
                $cat_filter[$cat->id] = $cat->translate->name;
                if ($cat->typeCars) {
                    $cat_filter = ArrayHelper::merge($cat_filter, self::getCategoryChild($cat->typeCars, $model));
                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->typeCars, $model));
                }
            }
        }

        $translation_en = StoreTypeCarTranslation::findOne(['type_car_id' => $model->id, 'locale' => 'en-EN']);
        $translation_ar = (!empty(StoreTypeCarTranslation::findOne(['type_car_id' => $model->id, 'locale' => 'ar-AE']))) ? StoreTypeCarTranslation::findOne(['type_car_id' => $model->id, 'locale' => 'ar-AE']) : new StoreTypeCarTranslation();
        $translation_ru = (!empty(StoreTypeCarTranslation::findOne(['type_car_id' => $model->id, 'locale' => 'ru-RU']))) ? StoreTypeCarTranslation::findOne(['type_car_id' => $model->id, 'locale' => 'ru-RU']) : new StoreTypeCarTranslation();

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dir = (__DIR__).'/../../uploads/store-type-cars/';

            $image = UploadedFile::getInstance($model, 'image');

            if($image){
                $path = $image->baseName.'.'.$image->extension;
                if($image->saveAs($dir.$path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir.$path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-type-car']['image'][0], Yii::$app->params['imageSizes']['store-type-car']['image'][1]);
                    $image_name = uniqid().'.'.$image->extension;
                    $resizer->save($dir.$image_name);
                    $model->image = '/uploads/store-type-cars/'.$image_name;
                    if(file_exists($dir.$path)) unlink($dir.$path);
                }
            } else $model->image = $old_image;

            $model->parent_id = ($model->parent_id > 0)? $model->parent_id: null;
            $model->save();

            $translation_en->type_car_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['en'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['en']: '';
            $translation_en->save();

            $translation_ar->type_car_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['ar'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['ar']: $translation_en->name;
            $translation_ar->save();

            $translation_ru->type_car_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->name = (Yii::$app->request->post('StoreTypeCarTranslation')['name']['ru'] != '')? Yii::$app->request->post('StoreTypeCarTranslation')['name']['ru']: $translation_en->name;
            $translation_ru->save();

            if (empty(Yii::$app->request->post('StoreTypeCar')['slug'])) {
                $model->slug = Helper::toSlug($translation_en->name).'_'.$model->id;
            } else {
                $model->slug = Helper::toSlug(Yii::$app->request->post('StoreTypeCar')['slug']) . '_'.$model->id;
            }
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
            'cat_filter' => $cat_filter,
            'cat_options' => $cat_options,
        ]);
    }

    /**
     * Deletes an existing StoreTypeCar model.
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

    /**
     * Finds the StoreTypeCar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreTypeCar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreTypeCar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
            if ($style) $result[$item->id] = $prefix . $item->translate->name;
            else $result[$item->id] = $prefix . $item->translate->name;
            if ($item->typeCars) {
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
            $result[$item->id] =  ['style' => 'font-weight: bold;'];
        }
        return $result;
    }
}
