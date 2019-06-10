<?php

namespace backend\controllers;

use common\components\Helper;
use common\components\SimpleImage;
use common\models\StoreCategoryTranslation;
use Yii;
use common\models\StoreCategory;
use backend\models\CategorySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class StoreCategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $parents = StoreCategory::find()->select('parent_id')->orderBy('parent_id')->groupBy('parent_id')->all();

        $parent_filter = [];
        if(!empty($parents)) {
            foreach ($parents as $parent) {
                if($parent->parent_id != '') $parent_filter[$parent->parent->id] = $parent->parent->translate->title;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent_filter' => $parent_filter,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreCategory();
        $translation_en = new StoreCategoryTranslation();
        $translation_ar = new StoreCategoryTranslation();
        $translation_ru = new StoreCategoryTranslation();

        if ($model->id > 0) {
            $cats = StoreCategory::find()->where(['parent_id' => null])->andWhere('`id` != ' . $model->id)->all();
        } else $cats = StoreCategory::find()->where(['parent_id' => null])->all();

        $cat_filter[] = 'No parent';
        $cat_options = [];
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                if ($model->id == $cat->id) continue;
                $cat_filter[$cat->id] = $cat->translate->title;
                if ($cat->categories) {
                    $cat_filter = ArrayHelper::merge($cat_filter, self::getCategoryChild($cat->categories, $model));
                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->categories, $model));
                }
            }
        }

//        echo '<pre>';
//        print_r(Yii::$app->request->post());
//        echo '</pre>';exit;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->parent_id = ($model->parent_id > 0)? $model->parent_id: null;
            $model->slug = '_'.uniqid();
            $dir = (__DIR__).'/../../uploads/store-categories/';
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->image){
                $path = $model->image->baseName.'.'.$model->image->extension;
                if($model->image->saveAs($dir.$path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir.$path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-categories']['image'][0], Yii::$app->params['imageSizes']['store-categories']['image'][1]);
                    $image_name = uniqid().'.'.$model->image->extension;
                    $resizer->save($dir.$image_name);
                    $model->image = '/uploads/store-categories/'.$image_name;
                    if(is_file($dir.$path)) if(file_exists($dir.$path)) unlink($dir.$path);
                }
            } else $model->image = '/uploads/site/default_cat.png';

            $model->save();

            $translation_en->category_id = $model->id;
            $translation_en->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['en']: '';
            $translation_en->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['en']: '';
            $translation_en->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['en']: '';
            $translation_en->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['en']: '';
            $translation_en->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['en']: '';
            $translation_en->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['en']: '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->category_id = $model->id;
            $translation_ar->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['ar']: $translation_en->title;
            $translation_ar->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['ar']: $translation_en->short;
            $translation_ar->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['ar']: $translation_en->description;
            $translation_ar->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ar']: $translation_en->meta_title;
            $translation_ar->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ar']: $translation_en->meta_description;
            $translation_ar->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ar']: $translation_en->meta_keywords;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->category_id = $model->id;
            $translation_ru->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['ru']: $translation_en->title;
            $translation_ru->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['ru']: $translation_en->short;
            $translation_ru->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['ru']: $translation_en->description;
            $translation_ru->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ru']: $translation_en->meta_title;
            $translation_ru->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ru']: $translation_en->meta_description;
            $translation_ru->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ru']: $translation_en->meta_keywords;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            if (empty(Yii::$app->request->post('Category')['slug'])) {
                $model->slug = Helper::toSlug($translation_en->title).'_'.$model->id;
            } else {
                $model->slug = Helper::toSlug(Yii::$app->request->post('Category')['slug']) . '_'.$model->id;
            }
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        }
//        echo '<pre>';
//        print_r($model->validate());
//        echo '</pre>';exit;

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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->id > 0) {
            $cats = StoreCategory::find()->where(['parent_id' => null])->andWhere('`id` != ' . $model->id)->all();
        } else $cats = StoreCategory::find()->where(['parent_id' => null])->all();

        $cat_filter[] = 'No parent';
        $cat_options = [];
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                if ($model->id == $cat->id) continue;
                $cat_filter[$cat->id] = $cat->translate->title;
                if ($cat->categories) {
                    $cat_filter = ArrayHelper::merge($cat_filter, self::getCategoryChild($cat->categories, $model));
                    $cat_options = ArrayHelper::merge($cat_options, self::getCategoryOptions($cat->categories, $model));
                }
            }
        }

        $translation_en = StoreCategoryTranslation::findOne(['category_id' => $model->id, 'locale' => 'en-EN']);
//        $translation_en->scenario = 'create';
        $translation_ar = (!empty(StoreCategoryTranslation::findOne(['category_id' => $model->id, 'locale' => 'ar-AE']))) ? StoreCategoryTranslation::findOne(['category_id' => $model->id, 'locale' => 'ar-AE']) : new StoreCategoryTranslation();
        $translation_ru = (!empty(StoreCategoryTranslation::findOne(['category_id' => $model->id, 'locale' => 'ru-RU'])))? StoreCategoryTranslation::findOne(['category_id' => $model->id, 'locale' => 'ru-RU']): new StoreCategoryTranslation();
        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dir = (__DIR__).'/../../uploads/store-categories/';

            $image = UploadedFile::getInstance($model, 'image');

            if($image){
                $path = $image->baseName.'.'.$image->extension;
                if($image->saveAs($dir.$path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir.$path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-categories']['image'][0], Yii::$app->params['imageSizes']['store-categories']['image'][1]);
                    $image_name = uniqid().'.'.$image->extension;
                    $resizer->save($dir.$image_name);
                    $model->image = '/uploads/store-categories/'.$image_name;
                    if(file_exists($dir.$path)) unlink($dir.$path);
                }
            } else $model->image = $old_image;

            $model->parent_id = ($model->parent_id > 0)? $model->parent_id: null;
            $model->save();

            $translation_en->category_id = $model->id;
            $translation_en->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['en']: '';
            $translation_en->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['en']: '';
            $translation_en->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['en']: '';
            $translation_en->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['en']: '';
            $translation_en->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['en']: '';
            $translation_en->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['en'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['en']: '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->category_id = $model->id;
            $translation_ar->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['ar']: $translation_en->title;
            $translation_ar->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['ar']: $translation_en->short;
            $translation_ar->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['ar']: $translation_en->description;
            $translation_ar->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ar']: $translation_en->meta_title;
            $translation_ar->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ar']: $translation_en->meta_description;
            $translation_ar->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ar'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ar']: $translation_en->meta_keywords;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->category_id = $model->id;
            $translation_ru->title = (Yii::$app->request->post('StoreCategoryTranslation')['title']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['title']['ru']: $translation_en->title;
            $translation_ru->short = (Yii::$app->request->post('StoreCategoryTranslation')['short']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['short']['ru']: $translation_en->short;
            $translation_ru->description = (Yii::$app->request->post('StoreCategoryTranslation')['description']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['description']['ru']: $translation_en->description;
            $translation_ru->meta_title = (Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_title']['ru']: $translation_en->meta_title;
            $translation_ru->meta_description = (Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_description']['ru']: $translation_en->meta_description;
            $translation_ru->meta_keywords = (Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ru'] != '')? Yii::$app->request->post('StoreCategoryTranslation')['meta_keywords']['ru']: $translation_en->meta_keywords;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            if (empty(Yii::$app->request->post('Category')['slug'])) {
                $model->slug = Helper::toSlug($translation_en->title).'_'.$model->id;
            } else {
                $model->slug = Helper::toSlug(Yii::$app->request->post('Category')['slug']) . '_'.$model->id;
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreCategory::findOne($id)) !== null) {
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
            if ($style) $result[$item->id] = $prefix . $item->translate->title;
            else $result[$item->id] = $prefix . $item->translate->title;
            if ($item->categories) {
                $result = ArrayHelper::merge($result, self::getCategoryChild($item->categories, $model, $index + 1));
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
