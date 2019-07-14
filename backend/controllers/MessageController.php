<?php

namespace backend\controllers;

use Yii;
use common\models\Message;
use backend\models\StoreMessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @param string $language
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id, $language)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id, $language),
//        ]);
//    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Message();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id, 'language' => $model->language]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_ar = Message::find()->where(['id' => $id, 'language' => 'ar-AE'])->all();
        $model_ru = Message::find()->where(['id' => $id, 'language' => 'ru-RU'])->all();
        if(empty($model_ar[0])) $model_ar = new Message();
        else $model_ar = $model_ar[0];
        if(empty($model_ru[0])) $model_ru = new Message();
        else $model_ru = $model_ru[0];

        if ($model->load(Yii::$app->request->post())) {
            $model->translation = (Yii::$app->request->post('Message')['translation']['en'] != '')? Yii::$app->request->post('Message')['translation']['en']: '';
            $model->save();

            $model_ar->id = $model->id;
            $model_ar->translation = (Yii::$app->request->post('Message')['translation']['ar'] != '')? Yii::$app->request->post('Message')['translation']['ar']:$model->translation;
            $model_ar->language = 'ar-AE';
            $model_ar->save();

            $model_ru->id = $model->id;
            $model_ru->translation = (Yii::$app->request->post('Message')['translation']['ru'] != '')? Yii::$app->request->post('Message')['translation']['ru']:$model->translation;
            $model_ru->language = 'ru-RU';
            $model_ru->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_ar' => $model_ar,
            'model_ru' => $model_ru,
        ]);
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id, $language)
//    {
//        $this->findModel($id, $language)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $language
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne(['id' => $id, 'language' => 'en-EN'])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
