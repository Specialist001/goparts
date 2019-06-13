<?php
namespace frontend\controllers;


use common\models\Cars;
use common\models\StoreCategory;
use common\models\StoreProduct;
use common\models\User;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $products = StoreProduct::find()->where(['user_id'=>Yii::$app->user->getId()])->orderBy('order')->with('storeProductToCars')->all();

            return $this->render('product',[
                'products' => $products,
            ]);
        }

        return $this->goBack();
    }

    public function actionCreate()
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $model = new StoreProduct();

            $category = !empty(Yii::$app->request->get('category'))? Yii::$app->request->get('category'): false;

            if(empty($category = StoreCategory::findOne(['id' => $category, 'status' => 1]))) $category = false;
            if(!empty($category)) if(!empty($category->activeCategories))  $category = false;
            $unset = false;
            $temp_parent = $category;
            while ($temp_parent) {
                if (!$temp_parent->status) {
                    $unset = true;
                    break;
                }
                if (empty($temp_parent->parent)) break;
                $temp_parent = $temp_parent->parent;
            }

            if ($unset) $category = false;

            $cats = StoreCategory::find()->where(['parent_id' => null, 'status'=>1])->orderBy('`order`')->all();

            return $this->render('create',[
                'model' => $model,
                'cats' => $cats,
                'category' => $category,
            ]);
        }

        return $this->goBack();
    }

    public function actionGetCar($vendor)
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

//        $data = '<div class="form-group">';
//        $data .= '<label class="control-label" for="car">Car</label>';
//        $data .= '<select name="car[]" id="car_items" class="form-control car_items">';
        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Car model") . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }
//        $data .= "</select>";
//        $data .= "</div>";

//        echo json_encode(array('data => $data, 'error' => $error));
        return $this->asJson($data);
//        } else {
//            return null;
//        }
    }

    public function actionGetModification($vendor, $car)
    {
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor, 'car' => $car])->orderBy(['modification'=>SORT_ASC])->all();
        $cars_array = [];
        $years = [];

        if (count($cars)) {
            foreach ($cars as $key => $car_1) {
//                foreach ($car_1['modification'])
                $cars_array[$car_1['modification']] = $car_1['modification'];
                $years[$car_1['modification']] = self::getYear($vendor, $car, $car_1['modification']);
            }
        }


        echo '<pre>';
        print_r($cars_array);
        print_r($years);
        echo '</pre>';exit;

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

        $data = '<option disabled selected>' . Yii::t("StoreModule.store", "Select generation") . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }


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
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->all();
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
}