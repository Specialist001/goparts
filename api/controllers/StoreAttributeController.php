<?php

namespace api\controllers;


use api\transformers\MetaData;
use api\transformers\StoreAttributeList;
use common\models\StoreAttribute;

class StoreAttributeController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
//        $storeAttributes = null;

        $storeAttributes = StoreAttribute::find()->with('storeAttributeOptions')->all();

        if ($storeAttributes) {
            return $this->asJson([
                'data'=>StoreAttributeList::transform($storeAttributes),
                'meta' => MetaData::transform($storeAttributes['pagination']),]);
        } else {
            return $this->redirect(['site/error', 'message'=> 'Not Found', 'code'=>404]);
        }

    }


}