<?php

namespace backend\controllers;

use common\models\StoreAttribute;
use common\models\StoreAttributeOptionTranslation;
use common\models\StoreAttributeTranslation;
use Yii;
use common\models\StoreAttributeOption;
use backend\models\StoreAttributeOptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreAttributeOptionController implements the CRUD actions for StoreAttributeOption model.
 */
class StoreAttributeOptionController extends Controller
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
     * Lists all StoreAttributeOption models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreAttributeOptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $attributes = StoreAttribute::find()->all();

        $attribute_filter = [];
        if(!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $attribute_filter[$attribute->id] = $attribute->translate->title;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'attribute_filter' => $attribute_filter,
        ]);
    }

    /**
     * Displays a single StoreAttributeOption model.
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
     * Creates a new StoreAttributeOption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreAttributeOption();

        $store_attributes = StoreAttribute::find()->with('translate')->all();

        $attributes = [];
        foreach ($store_attributes as $store_attribute) {
            $attributes += [$store_attribute->id => $store_attribute->translate->title];
        }

        $translation_en = new StoreAttributeOptionTranslation();
        $translation_ar = new StoreAttributeOptionTranslation();
        $translation_ru = new StoreAttributeOptionTranslation();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $translation_en->attribute_option_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['en'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['en']: '';
            $translation_en->save();

            $translation_ar->attribute_option_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ar'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ar']: $translation_en->value;
            $translation_ar->save();

            $translation_ru->attribute_option_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ru'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ru']: $translation_en->value;
            $translation_ru->save();


            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'attributes' => $attributes,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Updates an existing StoreAttributeOption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $store_attributes = StoreAttribute::find()->with('translate')->all();

        $attributes = [];
        foreach ($store_attributes as $store_attribute) {
            $attributes += [$store_attribute->id => $store_attribute->translate->title];
        }

        $translation_en = StoreAttributeOptionTranslation::findOne(['attribute_option_id'=>$model->id, 'locale'=>'en-EN']);
        $translation_ar = (!empty(StoreAttributeOptionTranslation::findOne(['attribute_option_id'=>$model->id, 'locale'=>'ar-AE']))) ? StoreAttributeOptionTranslation::findOne(['attribute_option_id'=>$model->id, 'locale'=>'ar-AE']) : new StoreAttributeOptionTranslation();
        $translation_ru = (!empty(StoreAttributeOptionTranslation::findOne(['attribute_option_id'=>$model->id, 'locale'=>'ru-RU']))) ? StoreAttributeOptionTranslation::findOne(['attribute_option_id'=>$model->id, 'locale'=>'ru-RU']) : new StoreAttributeOptionTranslation();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $translation_en->attribute_option_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['en'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['en']: '';
            $translation_en->save();

            $translation_ar->attribute_option_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ar'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ar']: $translation_en->value;
            $translation_ar->save();

            $translation_ru->attribute_option_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->value = (Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ru'] != '')? Yii::$app->request->post('StoreAttributeOptionTranslation')['value']['ru']: $translation_en->value;
            $translation_ru->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'attributes' => $attributes,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Deletes an existing StoreAttributeOption model.
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
     * Finds the StoreAttributeOption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreAttributeOption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreAttributeOption::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
