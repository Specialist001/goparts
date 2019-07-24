<?php

namespace api\controllers;

use api\transformers\QueryAddList;
use api\transformers\QueryList;
use api\transformers\StoreCategoryList;
use common\components\SimpleImage;
use common\models\Cars;
use common\models\Query;
use common\models\QueryImage;
use common\models\StoreCategory;
use common\models\StoreCommission;
use common\models\User;
use common\models\UserCommission;
use frontend\models\QuerySearch;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class QueryController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
    }

    public function actionGetCar($vendor = null, $car = null, $modification = null, $year = null)
    {
        if ($vendor) {
            if ($car) {
                if($modification) {
                    if ($year) {
                        $cars = Cars::find()
                            ->where(['vendor'=>$vendor, 'car'=>$car, 'modification'=>$modification,'year'=>$year])->one();
                        $car_id = $cars->id;

                        return $this->asJson(['car_id'=>$car_id]);
                    } else {
                        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->orderBy(['year'=>SORT_ASC])->all();
                        $cars_array = [];

                        if (count($cars)) {
                            foreach ($cars as $key => $car) {
                                $cars_array[$car['year']] = $car['year'];
                            }
                        }

                        return $this->asJson(['year'=>$cars_array]);
                    }
                } else {
                    $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car])->orderBy(['modification'=>SORT_ASC])->all();
                    $cars_array = [];

                    if (count($cars)) {
                        foreach ($cars as $key => $car) {
                            $cars_array[$car['modification']] = $car['modification'];
                        }
                    }

                    return $this->asJson(['modification'=>$cars_array]);
                }
            } else {
//                $cars = Cars::find()->where(['vendor' => $vendor])->orderBy(['car'=>SORT_ASC])->all();
//                $cars_array = [];

                $query = new \yii\db\Query();
                $cars = $query->select(['car'])
                    ->from('cars')
                    ->where(['vendor' => $vendor])
                    ->orderBy(['car' => SORT_ASC])
                    ->distinct()
                    ->all();
                $cars_array = [];

                if (count($cars)) {
                    foreach ($cars as $key => $car) {
                        $cars_array[$car['car']] = $car['car'];
                    }
                }

                return $this->asJson(['car'=>$cars_array]);
            }

        } else {
            $cars = Cars::find()->all();

            $vendor_array = [];

            if (count($cars)) {
                foreach ($cars as $key => $car) {
                    $vendor_array[$car['vendor']] = $car['vendor'];
                }
            }

            return $this->asJson(['vendor'=>$vendor_array]);
        }
    }

    public function actionGetCarId($vendor = null, $car = null, $modification = null, $year = null)
    {
        if ($vendor) {
            if ($car) {
                if ($year) {
                    $cars = Cars::find()
                        ->where(['vendor'=>$vendor, 'car'=>$car, 'year'=>$year])->one();
                    $car_id = $cars->id;

                    return $this->asJson(['car_id'=>$car_id]);
                } else {
                    $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car])->orderBy(['year'=>SORT_ASC])->all();
                    $cars_array = [];

                    if (count($cars)) {
                        foreach ($cars as $key => $car) {
                            $cars_array[$car['year']] = $car['year'];
                        }
                    }

                    return $this->asJson(['year'=>$cars_array]);
                }
            } else {
//                $cars = Cars::find()->where(['vendor' => $vendor])->orderBy(['car'=>SORT_ASC])->all();
//                $cars_array = [];

                $query = new \yii\db\Query();
                $cars = $query->select(['car'])
                    ->from('cars')
                    ->where(['vendor' => $vendor])
                    ->orderBy(['car' => SORT_ASC])
                    ->distinct()
                    ->all();
                $cars_array = [];

                if (count($cars)) {
                    foreach ($cars as $key => $car) {
                        $cars_array[$car['car']] = $car['car'];
                    }
                }

                return $this->asJson(['car'=>$cars_array]);
            }

        } else {
            $cars = Cars::find()->all();

            $vendor_array = [];

            if (count($cars)) {
                foreach ($cars as $key => $car) {
                    $vendor_array[$car['vendor']] = $car['vendor'];
                }
            }

            return $this->asJson(['vendor'=>$vendor_array]);
        }
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role == User::ROLE_BUYER && Yii::$app->user->identity->status == User::STATUS_ACTIVE) {
            $model = new Query();
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

            $query_part = Yii::$app->request->post()['Query'];
            $query_data = Yii::$app->request->post()['QueryData'];

            $parts_array = [];

            if (Yii::$app->request->post()) {
                $car = Cars::findOne(['id'=>$query_data['car_id']]);

                $username = Yii::$app->user->getId() ? Yii::$app->user->identity->username : $query_data['name'];
                $email = Yii::$app->user->getId() ? Yii::$app->user->identity->email : $query_data['email'];
                $phone = Yii::$app->user->getId() ? Yii::$app->user->identity->phone : $query_data['phone'];

                if (!Yii::$app->user->id) {
                    $user = User::findByEmail($email);
                    if ($user) {
                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'signUpAuto-html', 'text' => 'signUpAuto-text'],
                                ['type'=>'all', 'user' => $user, 'password' => $password]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' Team'])
                            ->setTo($user->email)
                            ->setSubject('Thank You for your request! | ' . Yii::$app->params['appName'])
                            ->send();
                    } else {
                        $password = mt_rand(10000000, 99999999);
                        $user = new User();
                        $user->username = $query_data['name']; //$this->username;
                        $user->email = $query_data['email'];
                        $user->phone = $query_data['phone'];
                        $user->status = User::STATUS_ACTIVE;
                        $user->reg_type = 'auto';
                        $user->setPassword($password);
                        $user->generateAuthKey();
                        if ($user->save()) {
                            $store_commission = StoreCommission::findOne(['name'=>'auto']);
                            $user_commission = new UserCommission();
                            $user_commission->user_id = $user->id;
                            $user_commission->commission = $store_commission ? $store_commission->commission : 35;
                            $user_commission->save();

                            Yii::$app
                                ->mailer
                                ->compose(
                                    ['html' => 'signUpAuto-html', 'text' => 'signUpAuto-text'],
                                    ['type'=>'first','user' => $user, 'password' => $password]
                                )
                                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName'] . ' Team'])
                                ->setTo($user->email)
                                ->setSubject('Registration on ' . Yii::$app->params['appName'])
                                ->send();
                        }
                    }
                }

                foreach ($query_part as $key => $part) {
                    $model = new Query();
                    $model->car_id = $query_data['car_id'];
                    $model->vendor = $car->vendor;
                    $model->car = $car->car;
                    $model->modification = $car->modification;
                    $model->year = $car->year;
                    $model->transmission = $query_data['transmission'];
                    $model->fueltype = $query_data['fueltype'];
                    $model->engine = $query_data['engine'];
                    $model->drivetype = $query_data['drivetype'];

                    $model->title = $part['title'] ? $part['title'] : substr($part['description'],0,10);
                    $model->description = $part['description'];
                    $model->category_id = $part['category_id'];

                    $model->user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : $user->id;

                    $model->name = $username;
                    $model->phone = $phone;
                    $model->email = $email;

                    $model->save();

                    $dir = (__DIR__) . '/../../uploads/queries/';
                    $image = UploadedFile::getInstanceByName('Query['.$key.'][image]');
//                    print_r($image);exit;

                    if ($image) {
                        $path = $image->baseName . '.' . $image->extension;
                        if ($image->saveAs($dir . $path)) {
                            $resizer = new SimpleImage();
                            $resizer->load($dir . $path);
                            $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                            $image_name = uniqid() . '.' . $image->extension;
                            $resizer->save($dir . $image_name);
                            $model->image = '/uploads/queries/' . $image_name;
                            if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);
                        }
                    } else $model->image = null;

                    $images = UploadedFile::getInstancesByName('Query[' . $key . '][images]');
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            $image_model = new QueryImage();
                            $image_model->query_id = $model->id;
                            $image_model->main = 0;
                            $path = $image->baseName . '.' . $image->extension;
                            if ($image->saveAs($dir . $path)) {
                                $resizer = new SimpleImage();
                                $resizer->load($dir . $path);
                                $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                                $image_name = uniqid() . '.' . $image->extension;
                                $resizer->save($dir . $image_name);
                                $image_model->name = '/uploads/queries/' . $image_name;
                                if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);

                                $image_model->save();
                            }
                        }
                    } else {
                        $image_model = new QueryImage();
                        $image_model->query_id = $model->id;
                        $image_model->name = '/uploads/site/vectorpaint.png';
                        $image_model->save();
                    }

                    $model->save();

                    $parts_array[$key] = [
                        'id' => $model->id,
                        'title' => $model->title,
                        'car' => $model->vendor.' '.$model->car.' '.$model->modification.' '.$model->year,
                        'category_id' => $model->category_id,
                        'fueltype' => $model->fueltype,
                        'engine' => $model->engine,
                        'transmission' => $model->transmission,
                        'drivetype' => $model->drivetype,
                        'name' => $model->name,
                        'phone' => $model->phone,
                        'email' => $model->email,
                    ];

                }

//                Yii::$app
//                    ->mailer
//                    ->compose(
//                        ['html' => 'makeQuery-html', 'text' => 'makeQuery-text'],
//                        [
//                            'type' => 'buyer',
//                            'parts' => $parts_array
//                        ]
//                    )
//                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
//                    ->setTo($query_data['email'])
//                    ->setSubject('Your request  | '.Yii::$app->name)
//                    ->send();

                return $this->asJson(['parts'=>$parts_array,
//                    'data'=>QueryAddList::transform($model),
                    'query_status'=>'Added']);
            }
            return $this->redirect(['site/error', 'message' => 'Not post data', 'code' => 404]);
        }
        return $this->redirect(['site/error', 'message' => 'You have not permission for add request', 'code' => 404]);
    }

}
