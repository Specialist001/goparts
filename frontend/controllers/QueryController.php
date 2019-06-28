<?php

namespace frontend\controllers;

use common\components\SimpleImage;
use common\models\Cars;
use common\models\StoreCategory;
use common\models\StoreOption;
use common\models\User;
use Yii;
use common\models\Query;
use frontend\models\QuerySearch;
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
        $searchModel = new QuerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->identity->role == User::ROLE_BUYER || Yii::$app->user->isGuest) {

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->goBack();
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
     * Creates a new Query model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->role == User::ROLE_BUYER && Yii::$app->user->identity->status == User::STATUS_ACTIVE || Yii::$app->user->isGuest) {
            $model = new Query();
            $category = !empty(Yii::$app->request->get('category'))? Yii::$app->request->get('category'): false;

            $car_id = !empty(Yii::$app->request->get('car_id')) ? Yii::$app->request->get('car_id') : false;

            $car = Cars::findOne(['id'=>$car_id]);
            $car_id = $car->id;

            $fuel_types = StoreOption::find()->where(['slug'=>'fuel-type'])->one();
            $fuel_array = [];
            foreach ($fuel_types->storeOptionValues as $fuel_type) {
                $fuel_array += [$fuel_type->value => $fuel_type->value];
            }

            $engines_types = StoreOption::find()->where(['slug'=>'engines-type'])->one();
            $engines_array = [];
            foreach ($engines_types->storeOptionValues as $engines_type) {
                    $engines_array += [$engines_type->value => $engines_type->value];
            }

            $transmissions = StoreOption::find()->where(['slug'=>'transmission'])->one();
            $transmissions_array = [];
            foreach ($transmissions->storeOptionValues as $transmission) {
                    $transmissions_array += [$transmission->value => $transmission->value];
            }

            $cats = StoreCategory::find()->where(['parent_id' => null, 'status'=>1])->orderBy('`order`')->all();

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

//            echo '<pre>';
//            print_r(Yii::$app->request->post());
//            echo '</pre>';
//            exit;

            if (Yii::$app->request->post()) {


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


                    $model->user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : null;

//                    $model->save();

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


                    $model->name = $query_data['name'];
                    $model->phone = $query_data['phone'];
                    $model->email = $query_data['email'];

                    $model->save();


//                    $parts_array[$key] += [$model];
                }



                return $this->redirect(['/query']);
            }
//            print_r(Yii::$app->request->post());exit;

            return $this->render('create', [
                'model' => $model,
                'cats' => $cats,
                'category' => $category,
                'car_id' => $car_id,
                'fuel_array' => $fuel_array,
                'transmissions_array' => $transmissions_array,
                'engines_array' => $engines_array,
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
}
