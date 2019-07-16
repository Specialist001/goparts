<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use common\models\SellerQuery;
use frontend\models\SellerQuerySearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SellerQueryController implements the CRUD actions for SellerQuery model.
 */
class SellerQueryController extends Controller
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
     * Lists all SellerQuery models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
                $searchModel = new SellerQuerySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $query = SellerQuery::find()->where(['seller_id'=>Yii::$app->user->identity->getId()])->andWhere(['<','status',3])->orderBy('`created_at` DESC');
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $seller_queries = $query->offset($pages->offset)->limit($pages->limit)->all();


                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'seller_queries'=>$seller_queries,
                    'pages' => $pages
                ]);
            }
        }

        return $this->goHome();
    }

    public function actionPurchased()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
                $searchModel = new SellerQuerySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $query = SellerQuery::find()->where(['seller_id'=>Yii::$app->user->identity->getId(), 'status'=>3])->andWhere(['IS NOT', 'product_id', null])->orderBy('`created_at` DESC')->with('product');
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $purchased_products = $query->offset($pages->offset)->limit($pages->limit)->all();


                return $this->render('purchased', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'purchased_products' => $purchased_products,
                    'pages' => $pages
                ]);
            }
        }

        return $this->goHome();
    }

    /**
     * Displays a single SellerQuery model.
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
     * Finds the SellerQuery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SellerQuery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SellerQuery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new SellerQuery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SellerQuery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SellerQuery model.
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
     * Deletes an existing SellerQuery model.
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
}
