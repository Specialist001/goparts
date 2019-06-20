<?php

namespace frontend\controllers;

use common\models\StoreOrder;
use common\models\StoreProduct;
use frontend\models\ProfileForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'purchase-delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        Yii::$app->session->set('active_category', '');
        $model = new ProfileForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->updateProfile()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['user/index']);
                }
            }
        }


        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionProducts()
    {
        if (Yii::$app->user->identity->role == 1) {
        $products = StoreProduct::find()->where(['user_id'=>Yii::$app->user->getId()])->orderBy('order')->with('storeProductToCars')->all();

        return $this->render('product',[
            'products' => $products,
        ]);
        }

        return $this->goBack();
    }

    public function actionPurchases()
    {
        $statuses = [
            ['Check availability', 'info'],
            ['Order canceled', 'danger'],
            ['Waiting for payment', 'info'],
            ['You can pickup goods', 'success'],
        ];

        $query = StoreOrder::find()->where(['user_id' => Yii::$app->user->id])->orderBy('`created_at` DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $orders = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('purchases', [
            'orders' => $orders,
            'pages' => $pages,
            'statuses' => $statuses
        ]);
    }

    public function actionPurchase($id)
    {
        $order = StoreOrder::findOne(['user_id' => Yii::$app->user->id, 'id' => $id]);
        if (empty($order)) return $this->redirect(['site/error']);

        $statuses = [
            ['Check availability', 'info'],
            ['Order canceled', 'danger'],
            ['Waiting for payment', 'info'],
            ['You can pickup goods', 'success'],
        ];
        return $this->render('purchase', [
            'order' => $order,
            'statuses' => $statuses
        ]);
    }
}
