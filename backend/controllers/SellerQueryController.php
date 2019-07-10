<?php

namespace backend\controllers;

use rmrevin\yii\fontawesome\FA;
use Yii;
use common\models\SellerQuery;
use backend\models\SellerQuerySearch;
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
        $searchModel = new SellerQuerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SellerQuery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->post()) {
            if ($model->query->email) {

                if (Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                        [
                            'type' => 'buyer',
                            'product_id' => $model->product_id,
                            'query_name' => $model->query->description,
                            'query_date' => date('d/m/Y', $model->query->created_at),
                            'query_car_name' => $model->query->vendor .' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year
                        ]
                    )
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                    ->setTo($model->query->email)
                    ->setSubject(Yii::$app->name)
                    ->send())
                {

                    $model->status = SellerQuery::STATUS_PUBLISHED;
                    $model->save();

                    return $this->render('view', [
                        'model' => $model,
                    ]);

                } else {
                    Yii::$app->session->setFlash('error', FA::i('warning').' Notification not sent to buyer');
                    return $this->goBack();
                }
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
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

            if ($model->status == SellerQuery::STATUS_PUBLISHED) {
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                    [
                        'type' => 'buyer',
                        'product_id' => $model->product_id,
                        'query_name' => $model->query->title,
                        'query_date' => $model->query->created_at,
                        'query_car_name' => $model->query->vendor .' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year
                    ]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($model->query->email)
                ->setSubject('Added product by your request #'.$model->query_id .' | '.Yii::$app->name)
                ->send();

            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                    ['type' => 'admin',
                        'product_id' => $model->id,
                        'query_name' => $model->query->title,
                        'query_date' => $model->query->created_at,
                        'query_car_name' => $model->query->vendor .' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year
                    ]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject(Yii::$app->name)
                ->send();
            }

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

    public function actionSendBuyer()
    {
        $posts = Yii::$app->request->post();
        $id = $posts['id'];
        $query_id = $posts['query_id'];

        $model = $this->findModel($id);
        $data = [];

        if ($model->query->user_id) {
            if ($model->query->user->email) {
                if (Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                        [
                            'type' => 'buyer',
                            'product_id' => $model->product->id,
                            'query_name' => $model->query->description,
                            'token' => base64_encode($model->query->user->email),
                            'query_date' => date('d/m/Y', $model->query->created_at),
                            'query_car_name' => $model->query->vendor .' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year
                        ]
                    )
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                    ->setTo($model->query->user->email)
                    ->setSubject('Product Added')
                    ->send())
                {
                    $model->status = SellerQuery::STATUS_PUBLISHED;
                    $model->save();
                    $data['status']['text'] = 'Request send to buyer';
                    $data['status']['code'] = 1;

                    return $this->asJson($data);
                } else {
                    $data['status']['text'] = 'Request not send to buyer';
                    $data['status']['code'] = -1;               
                    
                    return $this->asJson($data);
                }
            } else {
                $model->status = SellerQuery::STATUS_PUBLISHED;
                $model->save();

                $data['status']['text'] = 'Product published, but Request not send to buyer';
                $data['status']['code'] = 0;
                
                return $this->asJson($data);
            }
        } else {
            if ($model->query->email) {
                if (Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                        [
                            'type' => 'buyer',
                            'buyer_name' => $model->query->name,
                            'product_id' => $model->product->id,
                            'token' => base64_encode($model->query->email),
                            'query_name' => $model->query->description,
                            'query_date' => date('d/m/Y', $model->query->created_at),
                            'query_car_name' => $model->query->vendor .' '.$model->query->car.' '.$model->query->modification.' '.$model->query->year
                        ]
                    )
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' robot'])
                    ->setTo($model->query->email)
                    ->setSubject('Product added')
                    ->send())
                {
                    $model->status = SellerQuery::STATUS_PUBLISHED;
                    $model->save();

                    $data['status']['text'] = 'Request send to buyer';
                    $data['status']['code'] = 1;

                    return $this->asJson($data);
                } else {
                    $data['status']['text'] = 'Request not send to buyer';
                    $data['status']['code'] = -1;
                    

                    return $this->asJson($data);
                }
            } else {
                $model->status = SellerQuery::STATUS_PUBLISHED;
                $model->save();

                $data['status']['text'] = 'Product published, but Request not send to buyer';
                $data['status']['code'] = 0;
                
                return $this->asJson($data);
            }
        }

    }
}
