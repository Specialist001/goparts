<?php
namespace frontend\controllers;

use common\models\Cars;
use common\models\StoreProduct;
use yii\web\Controller;

class CarController extends Controller
{
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
//        return $products;

//        echo '<pre>';
//        print_r($products);
//        echo '</pre>';
//        exit;


        return $this->render('search',[
            'products' => $products,
        ]);
    }
}