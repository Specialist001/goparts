<?php

namespace backend\controllers;

use common\models\StoreAttributeTranslation;
use Yii;
use common\models\StoreAttribute;
use backend\models\StoreAttributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreAttributeController implements the CRUD actions for StoreAttribute model.
 */
class StoreAttributeController extends Controller
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
     * Lists all StoreAttribute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreAttribute model.
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
     * Creates a new StoreAttribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreAttribute();

        $translation_en = new StoreAttributeTranslation();
        $translation_ar = new StoreAttributeTranslation();
        $translation_ru = new StoreAttributeTranslation();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $translation_en->attribute_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['en'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['en']: '';
            $translation_en->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['en'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['en']: '';
            $translation_en->save();

            $translation_ar->attribute_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['ar'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['ar']: $translation_en->title;
            $translation_ar->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['ar'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['ar']: $translation_en->description;
            $translation_ar->save();

            $translation_ru->attribute_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['ru'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['ru']: $translation_en->title;
            $translation_ru->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['ru'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['ru']: $translation_en->description;
            $translation_ru->save();

//            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Updates an existing StoreAttribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $translation_en = StoreAttributeTranslation::findOne(['attribute_id'=>$model->id,'locale'=>'en-EN']);
        $translation_ar = (!empty(StoreAttributeTranslation::findOne(['attribute_id'=>$model->id,'locale'=>'ar-AE']))) ? StoreAttributeTranslation::findOne(['attribute_id'=>$model->id,'locale'=>'ar-AE']) : new StoreAttributeTranslation();
        $translation_ru = (!empty(StoreAttributeTranslation::findOne(['attribute_id'=>$model->id,'locale'=>'ru-RU']))) ? StoreAttributeTranslation::findOne(['attribute_id'=>$model->id,'locale'=>'ru-RU']) : new StoreAttributeTranslation();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $translation_en->attribute_id = $model->id;
            $translation_en->locale = 'en-EN';
            $translation_en->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['en'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['en']: '';
            $translation_en->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['en'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['en']: '';
            $translation_en->save();

            $translation_ar->attribute_id = $model->id;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['ar'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['ar']: $translation_en->title;
            $translation_ar->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['ar'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['ar']: $translation_en->description;
            $translation_ar->save();

            $translation_ru->attribute_id = $model->id;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->title = (Yii::$app->request->post('StoreAttributeTranslation')['title']['ru'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['title']['ru']: $translation_en->title;
            $translation_ru->description = (Yii::$app->request->post('StoreAttributeTranslation')['description']['ru'] != '')? Yii::$app->request->post('StoreAttributeTranslation')['description']['ru']: $translation_en->description;
            $translation_ru->save();

//            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Deletes an existing StoreAttribute model.
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
     * Finds the StoreAttribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreAttribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreAttribute::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
