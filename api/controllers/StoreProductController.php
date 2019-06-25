<?php

namespace api\controllers;

use common\models\Cars;
use common\models\StoreProduct;
use api\transformers\StoreProductList;
use yii\db\Expression;

class StoreProductController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {

    }

    public function actionShow($id)
    {
        if ($id) {
            $product = StoreProduct::find()->where(['status'=>1, 'id'=>$id])->all();
            return $this->asJson([
                'data' => StoreProductList::transform($product),
            ]);
        } else {
            return $this->redirect(['site/error', 'message' => 'Not Found', 'code' => 404]);
        }
    }

    public function actionSearch($vendor, $car=null, $modification=null, $category_id = null, $type_car_id = null)
    {
//        self::getCar()
        $cars = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->all();

        if (!empty($car)) {
            if (!empty($modification)) {
                $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->min('id');
                $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->max('id');
            } else {
            $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car'=>$car])->min('id');
            $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car'=>$car])->max('id');
            }
        } else {
            $car_id_min = Cars::find()->where(['vendor' => $vendor])->min('id');
            $car_id_max = Cars::find()->where(['vendor' => $vendor])->max('id');
        }

        $products = StoreProduct::find()->where(['between','car_id',$car_id_min,$car_id_max])->andWhere(['status'=>1])->all();

//        $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->min('id');
//        $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->max('id');


        if (!empty($category_id)){
            $products = StoreProduct::find()->where(['between','car_id',$car_id_min,$car_id_max])->andWhere(['category_id'=>$category_id])->andWhere(['status'=>1])->all();
        }
        if (!empty($type_car_id)) {
            $products = StoreProduct::find()->where(['between','car_id',$car_id_min,$car_id_max])->andWhere(['type_car_id'=>$type_car_id])->andWhere(['status'=>1])->all();
        }
        if (!empty($category_id) && !empty($type_car_id)) {
            $products = StoreProduct::find()->where(['between','car_id',$car_id_min,$car_id_max])->andWhere(['category_id'=>$category_id, 'type_car_id'=>$type_car_id])->andWhere(['status'=>1])->all();
        }

//        return $this->asJson($products);
        return $this->asJson([
            'products' => StoreProductList::transform($products),
        ]);
    }

    public function actionGetCars($vendor)
    {
//        if (Yii::$app->request->isAjax) {
//            $car_vendor = Yii::$app->request->post('vendor_name');
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['car']] = $car['car'];
            }
        }
        $data = $cars_array;

        return $this->asJson($data);
    }

    public function actionGetVendors()
    {
        $cars = Cars::find()->all();

        $vendor_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $vendor_array[$car['vendor']] = $car['vendor'];
            }
        }

        return $this->asJson($vendor_array);
    }

    public function actionGetModification($vendor, $car)
    {
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor, 'car' => $car])->orderBy(['modification'=>SORT_ASC, 'year'=>SORT_DESC])->all();
        $cars_array = [];
        $years = [];
        $min_max = [];

        if (count($cars)) {
            foreach ($cars as $key => $car_1) {
                $cars_array[$car_1['modification']] = $car_1['modification'];
                $years[$car_1['modification']] = self::getYear($vendor, $car, $car_1['modification']);

                $min_max[$car_1['modification']] =  [
                    'min'=>$min = min($years[$car_1['modification']]),
                    'max'=>$max = max($years[$car_1['modification']])
                ];
            }
        }
        $data = $min_max;
//        echo '<pre>';
//        print_r($min_max);
//        echo '<br>';
//        print_r($cars_array);
////        print_r($years);
//        echo '</pre>';

//        $query_years = (new Query())
//            ->select(['modification, min(year) AS min, max(year) AS max'])
//            ->from('cars')
//            ->distinct()
//            ->where(['vendor'=>$car_vendor])
//            ->andWhere(['car'=>$car])
//            ->groupBy(['car'])
//            //->andWhere(['modification'=>$car_modification])
//            ->all();
//        $query_years = Cars::find()
//            ->select(['modification, min(year) AS min, max(year) AS max'])
//            ->where(['vendor'=>$car_vendor])
//            ->andWhere(['car'=>$car])
//            ->groupBy('year')
//            ->all();

//        $data = '<option disabled selected>' . 'Select Generation' . '</option>';
//        if (count($min_max)) {
//            foreach ($min_max as $key => $car_array) {
//                $data .= '<option value="' . $key . '">' . $key .' ('. $car_array['min'].' - '.$car_array['max'] .')' . '</option>';
//            }
//        }
//        exit;


//        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Select generation") . '</option>';
//        if (count($query_years)) {
//            foreach ($query_years as $key => $query_year) {
//                $data .= '<option value="' . $query_year . '">' . $car_array . '</option>';
//            }
//        }

        return $this->asJson($data);
    }

    public function actionGetYear($vendor, $car, $modification)
    {
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->orderBy(['year'=>SORT_ASC])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['year']] = $car['year'];
            }
        }

        $data = '<option disabled selected>' . 'Year' . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }

        return $this->asJson($data);
    }

    public function getYear($vendor, $car, $modification)
    {
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->all();
        $cars_array = [];

        if (count($cars)) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['year']] = $car['year'];
            }
        }

        return $cars_array;
    }

    public function actionCreate()
    {

    }

}
