<?php

namespace api\controllers;

use api\transformers\StoreCategoryList;
use api\transformers\StoreQueryList;
use common\models\SellerQuery;
use common\models\StoreCategory;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;

class StoreQueryController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => HttpBasicAuth::className(),
                'auth' => function ($email, $password) {
                    $user = User::findByEmail($email);
                    if (!$user) return null;
                    $check = $user->validatePassword($password);
                    return $check? $user: null;
                }
            ]
        ];
    }


    public function actionIndex($id = null)
    {
        if (!Yii::$app->user->isGuest) {
            $queries = null;
            if ($id) {
                $queries = SellerQuery::find()->where(['seller_id' => Yii::$app->user->identity->getId(), 'id' => $id])->all();
            } else {
                $queries = SellerQuery::find()->where(['seller_id' => Yii::$app->user->identity->getId()])->orderBy('id')->all();
                //return $this->redirect(['site/error', 'message' => 'Not Found 1', 'code' => 404]);
            }
            if ($queries) {
                return $this->asJson(['data' => StoreQueryList::transform($queries)]);
            } else {
                return $this->redirect(['site/error', 'message' => Yii::$app->user->getId(), 'code' => 404]);
            }
        } return $this->asJson(['message'=>'Not Authorized']);
    }

    public function actionCategory($id = null)
    {
        $category = null;
        if ($id) {
            $category = StoreCategory::find()->where(['status' => 1, 'id' => $id])->orderBy('order')->all();
        } else {
            $category = StoreCategory::find()->where(['status' => 1, 'parent_id' => null])->orderBy('order')->all();
        }
        if ($category) {
            return $this->asJson(['data' => StoreCategoryList::transform($category)]);
        } else {
            return $this->redirect(['site/error', 'message' => 'Not Found', 'code' => 404]);
        }

    }

}
