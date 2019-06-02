<?php


namespace api\controllers;


use api\transformers\StoreTypeCarList;
use common\models\StoreType;
use common\models\StoreTypeCar;

class StoreTypeCarController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex($id = null)
    {
        $typeCar = null;
        if ($id) {
            $typeCar = StoreTypeCar::find()->where(['status'=>1, 'id' => $id])->orderBy('order')->all();
        } else {
            $typeCar = StoreTypeCar::find()->where(['status'=>1, 'parent_id' => null])->orderBy('order')->all();
        }
        if ($typeCar) {
            return $this->asJson(['data' => StoreTypeCarList::transform($typeCar)]);
        } else {
            return $this->redirect(['site/error', 'message'=> 'Not Found', 'code'=>404]);
        }
    }

}