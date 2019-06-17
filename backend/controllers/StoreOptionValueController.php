<?php

namespace backend\controllers;

use common\models\StoreOption;
use Yii;
use common\models\StoreOptionValue;
use backend\models\StoreOptionValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreOptionValueController implements the CRUD actions for StoreOptionValue model.
 */
class StoreOptionValueController extends Controller
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
     * Lists all StoreOptionValue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreOptionValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreOptionValue model.
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
     * Creates a new StoreOptionValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreOptionValue();
        $options = StoreOption::find()->where(['status'=>1])->all();

        $options_array = [];
        foreach ($options as $option) {
            $options_array += [$option->id => $option->name];
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'options_array' => $options_array,
        ]);
    }

    /**
     * Updates an existing StoreOptionValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $options = StoreOption::find()->where(['status'=>1])->all();

        $options_array = [];
        foreach ($options as $option) {
            $options_array += [$option->id => $option->name];
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'options_array' => $options_array,
        ]);
    }

    /**
     * Deletes an existing StoreOptionValue model.
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
     * Finds the StoreOptionValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreOptionValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreOptionValue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
