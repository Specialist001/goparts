<?php

namespace backend\controllers;

use common\models\SellerCar;
use common\models\SellerQuery;
use Yii;
use common\models\Query;
use backend\models\QuerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QueryController implements the CRUD actions for Query model.
 */
class QueryController extends Controller
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Query models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Query model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $sellers = SellerCar::find()->where(['vendor_name'=>$model->vendor])->all();

        return $this->render('view', [
            'model' => $model,
            'sellers' => $sellers,
        ]);
    }

    /**
     * Creates a new Query model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Query();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Query model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Query model.
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
     * Finds the Query model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Query the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Query::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSendSellers()
    {
        $posts = Yii::$app->request->post();
        $data = [];
        $query_id = $posts['query_id'];
        $model = $this->findModel($query_id);

        $sellers = $posts['sellers'];

        foreach ($sellers as $seller_id) {
            $seller_query = new SellerQuery();
            $seller_query->query_id = $query_id;
            $seller_query->seller_id = $seller_id;
            $seller_query->status = SellerQuery::STATUS_WAITED;

            if ($seller_query->save()) {
                $model->status = Query::STATUS_VERIFIED;
                $model->save();
                $data['status'] = 'Request send to sellers';
            } else {
                $data['status'] = 'Request not send';
            }
        }

        return $this->asJson($data);
    }
}
