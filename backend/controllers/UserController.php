<?php

namespace backend\controllers;

use common\models\Cars;
use common\models\SellerCar;
use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new User();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario= 'admin';
        $cars = Cars::getVendors();

        $car_1 = (!empty(SellerCar::findOne(['user_id'=>$model->id, 'order'=>1]))) ? SellerCar::findOne(['user_id'=>$model->id, 'order'=>1]) : new SellerCar();
        $car_2 = (!empty(SellerCar::findOne(['user_id'=>$model->id, 'order'=>2]))) ? SellerCar::findOne(['user_id'=>$model->id, 'order'=>2]) : new SellerCar();
        $seller_car_1 = SellerCar::find()->where(['user_id'=>$model->id, 'order'=>1])->one();
        $seller_car_2 = SellerCar::find()->where(['user_id'=>$model->id, 'order'=>2])->one();

//        if (!empty($seller_car_1)) {
//            $seller_car_1 = ArrayHelper::map($seller_car_1, 'order', 'vendor_name');
//        }
//        if (!empty($seller_car_2)) {
//            $seller_car_2 = ArrayHelper::map($seller_car_2, 'order', 'vendor_name');
//        }
//        echo '<pre>';
//        print_r($seller_car_1);
//        print_r($seller_car_2);
//        echo '</pre>';exit;

//        echo '<pre>';
//        print_r(Yii::$app->request->post());
//        echo '</pre>';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            $car_1->user_id = $model->id;
            $car_1->order = '1';
            $car_1->vendor_name = Yii::$app->request->post('car_1');
            $car_1->save();

            $car_2->user_id = $model->id;
            $car_2->order = '2';
            $car_2->vendor_name = Yii::$app->request->post('car_2');
            $car_2->save();

            $model->phone = ($model->phone == '')? null: $model->phone;

            if($model->password != '') {
                $model->setPassword($model->password);
                $model->generateAuthKey();
            }

            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cars' => $cars,
            'car_1' => $car_1,
            'car_2' => $car_2,
            'seller_car_1' => $seller_car_1,
            'seller_car_2' => $seller_car_2,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
