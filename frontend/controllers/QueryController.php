<?php

namespace frontend\controllers;

use common\components\SimpleImage;
use common\models\Cars;
use common\models\QueryImage;
use common\models\SellerQuery;
use common\models\StoreCategory;
use common\models\StoreCommission;
use common\models\StoreOption;
use common\models\StoreProductImage;
use common\models\User;
use common\models\UserCommission;
use rmrevin\yii\fontawesome\FA;
use Yii;
use common\models\Query;
use frontend\models\QuerySearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QueryController implements the CRUD actions for Query model.
 */
class QueryController extends Controller
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Query models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == User::ROLE_BUYER) {

            $searchModel = new QuerySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


            $query = Query::find()->where(['user_id' => Yii::$app->user->identity->getId()])->orderBy('`created_at` DESC');
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
            $buyer_queries = $query->offset($pages->offset)->limit($pages->limit)->all();
            $user_commission = (!empty(UserCommission::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one())) ? UserCommission::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one() : 1;
            $commission = $user_commission->commission;
            $commission = (1 + ($commission ?: 0) / 100);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'buyer_queries' => $buyer_queries,
                'commission' => $commission,
                'pages' => $pages
            ]);
        }

        return $this->goHome();
    }

    /**
     * Displays a single Query model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->role == User::ROLE_BUYER && Yii::$app->user->identity->status == User::STATUS_ACTIVE || Yii::$app->user->isGuest) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->goBack();
    }

    /**
     * Finds the Query model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Query the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Query::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Query model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->role == User::ROLE_BUYER && Yii::$app->user->identity->status == User::STATUS_ACTIVE || Yii::$app->user->isGuest) {
            $model = new Query();
            $category = !empty(Yii::$app->request->get('category')) ? Yii::$app->request->get('category') : false;

            $car_id = !empty(Yii::$app->request->get('car_id')) ? Yii::$app->request->get('car_id') : false;

            $car = Cars::findOne(['id' => $car_id]);
            $car_id = $car->id;

            $fuel_types = StoreOption::find()->where(['slug' => 'fuel-type'])->one();
            $fuel_array = [];
            if ($fuel_types) {
                foreach ($fuel_types->storeOptionValues as $fuel_type) {
                    $fuel_array += [$fuel_type->value => $fuel_type->value];
                }
            }

            $engines_types = StoreOption::find()->where(['slug' => 'engines-type'])->one();
            $engines_array = [];
            if ($engines_types) {
                foreach ($engines_types->storeOptionValues as $engines_type) {
                    $engines_array += [$engines_type->value => $engines_type->value];
                }
            }

            $transmissions = StoreOption::find()->where(['slug' => 'transmission'])->one();
            $transmissions_array = [];
            if ($transmissions) {
                foreach ($transmissions->storeOptionValues as $transmission) {
                    $transmissions_array += [$transmission->value => $transmission->value];
                }
            }

            $drive_types = StoreOption::find()->where(['slug' => 'drive-type'])->one();
            $drive_array = [];
            if ($drive_types) {
                foreach ($drive_types->storeOptionValues as $drive) {
                    $drive_array += [$drive->value => $drive->value];
                }
            }

            $cats = StoreCategory::find()->where(['parent_id' => null, 'status' => 1])->orderBy('`order`')->all();

            if (empty($category = StoreCategory::findOne(['id' => $category, 'status' => 1]))) $category = false;
            if (!empty($category)) if (!empty($category->activeCategories)) $category = false;
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
                                ['type' => 'all', 'user' => $user, 'password' => $password]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName']])
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
                            $store_commission = StoreCommission::findOne(['name' => 'auto']);
                            $user_commission = new UserCommission();
                            $user_commission->user_id = $user->id;
                            $user_commission->commission = $store_commission ? $store_commission->commission : 35;
                            $user_commission->save();

                            Yii::$app
                                ->mailer
                                ->compose(
                                    ['html' => 'signUpAuto-html', 'text' => 'signUpAuto-text'],
                                    ['type' => 'first', 'user' => $user, 'password' => $password]
                                )
                                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName']])
                                ->setTo($user->email)
                                ->setSubject('Registration on ' . Yii::$app->params['appName'])
                                ->send();
                        }
                    }
                }

                foreach ($query_part as $key => $part) {
                    $model = new Query();
                    $model->car_id = $query_data['car_id'];
                    $model->vendor = $query_data['vendor'];
                    $model->car = $query_data['car'];
                    $model->modification = $query_data['modification'];
                    $model->year = $query_data['year'];
                    $model->fueltype = $query_data['fueltype'];
                    $model->transmission = $query_data['transmission'];
                    $model->engine = $query_data['engine'];
                    $model->drivetype = $query_data['drivetype'];

                    $model->title = $part['title'];
                    $model->category_id = $part['category_id'];
                    $model->description = $part['description'];

                    $model->user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : $user->id;

                    $model->name = $username;
                    $model->phone = $phone;
                    $model->email = $email;

                    $model->save();
//                    $dir = (__DIR__) . '/../../uploads/queries/';
//                    $image = UploadedFile::getInstanceByName('Query['.$key.'][image]');

                    $image = UploadedFile::getInstanceByName('Query[' . $key . '][mainImage]');
                    $dir = (__DIR__) . '/../../uploads/queries/';
//                    echo '<pre>';
//                    print_r($model);
//                    echo '</pre>';
//                    exit;

                    if ($image) {
                        $image_model = new QueryImage();
                        $image_model->query_id = $model->id;
                        $image_model->main = 1;
                        $image_model->save();
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
                }


                if (!Yii::$app->user->id) {
                    return $this->redirect(['/',
                        'new_query' => 'send']);
                }

                return $this->redirect(['/query']);
            }

            return $this->render('create', [
                'model' => $model,
                'cats' => $cats,
                'category' => $category,
                'car_id' => $car_id,
                'fuel_array' => $fuel_array,
                'transmissions_array' => $transmissions_array,
                'engines_array' => $engines_array,
                'drive_array' => $drive_array,
            ]);
        }

        return $this->goBack();
    }

    /**
     * Updates an existing Query model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Query model.
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
}
