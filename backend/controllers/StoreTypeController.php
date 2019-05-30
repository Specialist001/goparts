<?php

namespace backend\controllers;

use common\models\StoreAttribute;
use common\models\StoreTypeAttribute;
use Yii;
use common\models\StoreType;
use backend\models\StoreTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreTypeController implements the CRUD actions for StoreType model.
 */
class StoreTypeController extends Controller
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
     * Lists all StoreType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreType model.
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
     * Creates a new StoreType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreType();

        $attributes = StoreAttribute::find()->all();
        $typeAttribute = new StoreTypeAttribute();

        $attribute_array = [];

        foreach ($attributes as $attribute) {
            $attribute_array += [$attribute->id => $attribute->name];
        }
        //print_r($attribute_array);


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $typeAttribute->type_id = $model->id;
            $typeAttribute->attribute_id = Yii::$app->request->post('StoreTypeAttribute')['id'];
            $typeAttribute->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'typeAttribute' => $typeAttribute,
            'attribute_array' => $attribute_array,
        ]);
    }

    /**
     * Updates an existing StoreType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $attributes = StoreAttribute::find()->all();
        $typeAttribute = StoreTypeAttribute::findOne(['type_id'=>$model->id]);
//        print_r($typeAttribute);exit;

        $attribute_array = [];

        foreach ($attributes as $attribute) {
            $attribute_array += [$attribute->id => $attribute->name];
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $typeAttribute->type_id = $model->id;
            $typeAttribute->attribute_id = Yii::$app->request->post('StoreTypeAttribute')['id'] ? Yii::$app->request->post('StoreTypeAttribute')['id']
                : $typeAttribute->attribute_id;

//            $typeAttribute->attribute_id =$typeAttribute->attribute_id ? $typeAttribute->attribute_id :
//                Yii::$app->request->post('StoreTypeAttribute')['id'];
            $typeAttribute->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'typeAttribute' => $typeAttribute,
            'attribute_array' => $attribute_array,
        ]);
    }

    /**
     * Deletes an existing StoreType model.
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
     * Finds the StoreType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
