<?php

namespace frontend\controllers;

use common\models\StoreProduct;
use frontend\models\ProfileForm;
use Yii;
use yii\filters\AccessControl;

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

}
