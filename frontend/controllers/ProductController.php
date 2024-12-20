<?php

namespace frontend\controllers;


use common\components\Helper;
use common\components\SimpleImage;
use common\models\Cars;
use common\models\SellerQuery;
use common\models\StoreCategory;
use common\models\StoreProduct;
use common\models\StoreProductImage;
use common\models\StoreProductToCar;
use common\models\StoreProductTranslation;
use common\models\StoreProductVideo;
use common\models\StoreTypeCar;
use common\models\User;
use rmrevin\yii\fontawesome\FA;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'get-car', 'get-modification', 'get-year', 'get-one-car'],
                'rules' => [

//                        'allow' => true,
//                        'roles' => ['?'],
                    [
                        'actions' => ['index', 'get-car', 'get-modification', 'get-year', 'get-one-car', 'search'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'get-car', 'get-modification', 'get-year', 'get-one-car', 'search', 'create', 'update', 'add', 'edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $products = StoreProduct::find()->where(['user_id' => Yii::$app->user->getId()])->orderBy('order')->with('storeProductToCars')->all();

            return $this->render('product', [
                'products' => $products,
            ]);
        }

        return $this->goBack();
    }

    public function actionCreate($query_id)
    {
        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            $seller = SellerQuery::find()->where(['seller_id' => Yii::$app->user->identity->getId(), 'query_id' => $query_id])->with('query')->one();

            if ($seller->seller_id == Yii::$app->user->identity->getId()) {
                if ($seller->query->car_id == Yii::$app->request->get('car_id')) {
//                    if ($seller->query->category_id == Yii::$app->request->get('category')) {

                    $model = new StoreProduct();
                    $video = new StoreProductVideo();

                    $category = !empty(Yii::$app->request->get('category')) ? Yii::$app->request->get('category') : false;

                    $vendor_name = !empty(Yii::$app->request->post('vendor')) ? Yii::$app->request->post('vendor') : null;
                    $car_name = !empty(Yii::$app->request->post('car')) ? Yii::$app->request->post('car') : null;
                    $modification_name = !empty(Yii::$app->request->post('modification')) ? Yii::$app->request->post('modification') : null;
                    $year = !empty(Yii::$app->request->post('year')) ? Yii::$app->request->post('year') : null;

                    $car = Cars::findOne(['id' => Yii::$app->request->get('car_id')]);
                    $car_id = $car->id;

//                        $car_id = !empty(Yii::$app->request->get('car_id')) ? Yii::$app->request->get('car_id') : false;

//                        if(empty($car_id = Cars::findOne(['id'=>$car_id]))) $car_id = false;

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

                    $translation_en = new StoreProductTranslation();
                    $translation_ar = new StoreProductTranslation();
                    $translation_ru = new StoreProductTranslation();

                    $cats = StoreCategory::find()->where(['parent_id' => null, 'status' => 1])->orderBy('`order`')->all();
                    $type_cars = StoreTypeCar::find()->where(['parent_id' => null])->all();

                    $cars_array = Cars::getVendors();

                    if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                        $model->user_id = Yii::$app->user->getId();

                        $model->save();
                        $image = UploadedFile::getInstanceByName('mainImage');
                        $dir = (__DIR__) . '/../../uploads/store-products/';

                        if ($image) {
                            $image_model = new StoreProductImage();
                            $image_model->product_id = $model->id;
                            $image_model->main = 1;
                            $path = $image->baseName . '.' . $image->extension;
                            if ($image->saveAs($dir . $path)) {
                                $resizer = new SimpleImage();
                                $resizer->load($dir . $path);
                                $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                                $image_name = uniqid() . '.' . $image->extension;
                                $resizer->save($dir . $image_name);
                                $image_model->link = '/uploads/store-products/' . $image_name;
                                if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);
                                $image_model->save();
                            } else {
                                Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
                                return $this->goBack();
                            }
                        } else {
                            $image_model = new StoreProductImage();
                            $image_model->product_id = $model->id;
                            $image_model->main = 1;
                            $image_model->link = '/uploads/site/default_product.png';
                            $image_model->save();
                        }

                        $images = UploadedFile::getInstancesByName('images');
                        if (!empty($images)) {
                            foreach ($images as $image) {
                                $image_model = new StoreProductImage();
                                $image_model->product_id = $model->id;
                                $image_model->main = 0;
                                $path = $image->baseName . '.' . $image->extension;
                                if ($image->saveAs($dir . $path)) {
                                    $resizer = new SimpleImage();
                                    $resizer->load($dir . $path);
                                    $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                                    $image_name = uniqid() . '.' . $image->extension;
                                    $resizer->save($dir . $image_name);
                                    $image_model->link = '/uploads/store-products/' . $image_name;
                                    if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);

                                    $image_model->save();
                                } else {
                                    Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
                                    return $this->goBack();
                                }
                            }
                        }

                        $model->save();

                        $model->car_id = $car_id;
                        $model->sku = Yii::$app->user->getId() . '-' . date('dmy') . '-' . $model->id;

                        $translation_en->product_id = $model->id;
                        $translation_en->name = (Yii::$app->request->post('StoreProductTranslation')['name']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['en'] : '';
                        $translation_en->short = (Yii::$app->request->post('StoreProductTranslation')['short']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['en'] : '';
                        $translation_en->description = (Yii::$app->request->post('StoreProductTranslation')['description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['en'] : '';
                        $translation_en->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['en'] : '';
                        $translation_en->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['en'] : '';
                        $translation_en->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['en'] : '';
                        $translation_en->locale = 'en-EN';
                        $translation_en->save();

                        $translation_ar->product_id = $model->id;
                        $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
                        $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
                        $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
                        $translation_ar->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] : $translation_en->meta_title;
                        $translation_ar->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] : $translation_en->meta_description;
                        $translation_ar->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] : $translation_en->meta_keywords;
                        $translation_ar->locale = 'ar-AE';
                        $translation_ar->save();

                        $translation_ru->product_id = $model->id;
                        $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
                        $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
                        $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
                        $translation_ru->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] : $translation_en->meta_title;
                        $translation_ru->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] : $translation_en->meta_description;
                        $translation_ru->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] : $translation_en->meta_keywords;
                        $translation_ru->locale = 'ru-RU';
                        $translation_ru->save();

                        $price = $model->price ? $model->price : 1;

                        $purchase_price = $price * (1 + ($model->user->commission->commission ? $model->user->commission->commission : 0) / 100);

                        $model->purchase_price = $purchase_price;
                        $model->save();
                        $car_vendor = Yii::$app->request->post('vendor_name');
                        $car_model = Yii::$app->request->post('car_name');
                        $car_modification = Yii::$app->request->post('modification_name');
                        $car_year = Yii::$app->request->post('year_name');

                        $car_name = $car_vendor ? $car_vendor . '-' : null . $car_model ? $car_model . '-' : null . $car_modification ? $car_modification . '-' : null . $car_year ? $car_year . '_' : null;

                        if (empty(Yii::$app->request->post('StoreProduct')['title'])) {
                            $model->title = Helper::toSlug($translation_en->name) . '_' . $model->id;
                        } else {
                            $model->title = Helper::toSlug(Yii::$app->request->post('StoreProduct')['title']) . '_' . $model->id;
                        }

                        if (empty(Yii::$app->request->post('StoreProduct')['slug'])) {
                            $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;
                        } else {
                            $model->slug = Helper::toSlug(Yii::$app->request->post('StoreProduct')['slug']) . '_' . $model->id;
                        }

                        $model->save();

                        $seller->product_id = $model->id;
                        $seller->status = SellerQuery::STATUS_MODERATE;
                        $seller->save();

                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                                [
                                    'type' => 'buyer',
                                    'product_id' => $model->id,
                                    'query_name' => $seller->query->title,
                                    'query_date' => $seller->query->created_at,
                                    'query_car_name' => $seller->query->vendor . ' ' . $seller->query->car . ' ' . $seller->query->modification . ' ' . $seller->query->year
                                ]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName']])
                            ->setTo($seller->query->email)
                            ->setSubject('Added product by your request #' . $seller->query->id . ' | ' . Yii::$app->params['appName'])
                            ->send();

                        Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
                                ['type' => 'admin',
                                    'product_id' => $model->id,
                                    'query_name' => $seller->query->title,
                                    'query_date' => $seller->query->created_at,
                                    'query_car_name' => $seller->query->vendor . ' ' . $seller->query->car . ' ' . $seller->query->modification . ' ' . $seller->query->year
                                ]
                            )
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                            ->setTo(Yii::$app->params['adminEmail'])
                            ->setSubject(Yii::$app->params['appName'])
                            ->send();

                        return $this->redirect(['update', 'id' => $model->id, 'category' => $model->category_id, 'car_id' => $car_id]);
                    }

                    return $this->render('create', [
                        'model' => $model,
                        'video' => $video,
                        'cats' => $cats,
                        'category' => $category,
                        'translation_en' => $translation_en,
                        'translation_ar' => $translation_ar,
                        'translation_ru' => $translation_ru,
                        'type_cars' => $type_cars,
                        'car_id' => $car_id,
                    ]);
//                    }

                } else {
                    return $this->goBack();
                }

            } else {
                return $this->goBack();
            }

            return $this->goBack();
        }
        return $this->goBack();
    }

    public function actionAdd($id = null, $query_id = null, $car_id = null)
    {
        $post = Yii::$app->request->post();
//        print_r($post);exit;
        $product_data = $post['Product'];
        $query_data = $post['SellerQuery'];
        if ($product_data['description']) {
            if ($product_data['price']) {
//
                $model = new StoreProduct();

                $model->car_id = $query_data['car_id'];
                $model->user_id = Yii::$app->user->identity->getId();

                $model->save();

//            $model->image = UploadedFile::getInstanceByName('image');
                $image = UploadedFile::getInstanceByName('mainImage');
                $dir = (__DIR__) . '/../../uploads/store-products/';

                if ($image) {
                    $image_model = new StoreProductImage();
                    $image_model->product_id = $model->id;
                    $image_model->main = 1;
                    $path = $image->baseName . '.' . $image->extension;
                    if ($image->saveAs($dir . $path)) {
                        $resizer = new SimpleImage();
                        $resizer->load($dir . $path);
                        $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                        $image_name = uniqid() . '.' . $image->extension;
                        $resizer->save($dir . $image_name);
                        $image_model->link = '/uploads/store-products/' . $image_name;
                        if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);
                        $image_model->save();
                    } else {
                        Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
                        return $this->goBack();
                    }
                }

                $images_json_array = [];
                $images = UploadedFile::getInstancesByName('Query[images]');
                if (!empty($images)) {
                    foreach ($images as $key => $image) {
                        $image_model = new StoreProductImage();
                        $image_model->product_id = $model->id;
                        $image_model->main = 0;
                        $path = $image->baseName . '.' . $image->extension;
                        if ($image->saveAs($dir . $path)) {
                            $resizer = new SimpleImage();
                            $resizer->load($dir . $path);
                            $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                            $image_name = uniqid() . '.' . $image->extension;
                            $resizer->save($dir . $image_name);
                            $image_model->link = '/uploads/store-products/' . $image_name;
                            if (is_file($dir . $path)) if (file_exists($dir . $path)) unlink($dir . $path);

                            $image_model->save();
                            $images_json_array += [$key => $image_model->link];
                        } else {
                            Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
                            return $this->goBack();
                        }
                    }
                } else {
                    $image_model = new StoreProductImage();
                    $image_model->product_id = $model->id;
                    $image_model->main = 0;
                    $image_model->link = '/uploads/site/vectorpaint.png';
                    $image_model->save();
                    $images_json_array += [0 => $image_model->link];
                }


                $model->sku = Yii::$app->user->getId() . '-' . date('dmy') . '-' . $model->id;

                $translation_en = new StoreProductTranslation();
                $translation_ar = new StoreProductTranslation();
                $translation_ru = new StoreProductTranslation();

                $translation_en->product_id = $model->id;
                $translation_en->name = $product_data['description'] ? mb_substr($product_data['description'], 0, 10) : '';
                $translation_en->short = $product_data['description'] ? mb_substr($product_data['description'], 0, 20) : '';
                $translation_en->description = $product_data['description'] ? $product_data['description'] : '';
                $translation_en->meta_title = $product_data['description'] ? mb_substr($product_data['description'], 0, 10) : '';
                $translation_en->meta_description = $product_data['description'] ? mb_substr($product_data['description'], 0, 20) : '';
                $translation_en->meta_keywords = $product_data['description'] ? str_replace(' ', ',', $product_data['description']) : '';
                $translation_en->locale = 'en-EN';
                $translation_en->save();

                $translation_ar->product_id = $model->id;
                $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
                $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
                $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
                $translation_ar->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] : $translation_en->meta_title;
                $translation_ar->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] : $translation_en->meta_description;
                $translation_ar->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] : $translation_en->meta_keywords;
                $translation_ar->locale = 'ar-AE';
                $translation_ar->save();

                $translation_ru->product_id = $model->id;
                $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
                $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
                $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
                $translation_ru->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] : $translation_en->meta_title;
                $translation_ru->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] : $translation_en->meta_description;
                $translation_ru->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] : $translation_en->meta_keywords;
                $translation_ru->locale = 'ru-RU';
                $translation_ru->save();

                $price = $product_data['price'] ? $product_data['price'] : 1;
                $purchase_price = $price * (1 + ($model->user->commission->commission ? $model->user->commission->commission : 0) / 100);

                $model->price = $price;
                $model->purchase_price = $purchase_price;

                $model->save();

                $model->title = Helper::toSlug(mb_substr($product_data['description'], 0, '15')) . '-';
                $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;

                $seller = SellerQuery::find()->where(['seller_id' => Yii::$app->user->identity->getId(), 'query_id' => $query_data['query_id']])->with('query')->one();
                $seller->product_id = $model->id;
                $seller->status = SellerQuery::STATUS_MODERATE;
                $seller->save();

                $get_prices = SellerQuery::find()->where(['query_id' => $query_data['query_id']])->andWhere(['not', ['product_id' => null]])->all();
                $price_array = [];
                $prices = [];
                foreach ($get_prices as $get_price) {
                    $price_array[] += $get_price->productPrice->price;
                }
                sort($price_array);
                $arrlength = count($price_array);
                if ($arrlength > 3) $counter = 3;
                else $counter = $arrlength;

                if ($counter > 0) {
                    for ($x = 0; $x < $counter; $x++) {
                        $prices += [$x => $price_array[$x]];
                    }
                } else {
                    $prices = null;
                }
                $image_array = [];
                $all_images = StoreProductImage::find()->where(['product_id'=>$model->id])->all();
                foreach ($all_images as $all_image) {
                    $image_array += [$all_image->id => $all_image->link];
                }

                return json_encode([
                    'error' => false,
                    'status' => 'Request sent',
                    'product_id' => $model->id,
                    'image_array' => $image_array,
                    'prices' => $prices,
                    'images_json_array' => $images_json_array,
                ]);
//                return $this->redirect(['/user/requests']);
            } else {
//                return json_encode([
//                    'error' => true,
//                    'errorData' => 'Price does not exist'
//                ]);
                Yii::$app->session->setFlash('error', FA::i('warning').' Price not found');
                return $this->redirect(['/user/requests']);
            }
        } else {
            Yii::$app->session->setFlash('error', FA::i('warning').' Description not found');
            return $this->redirect(['/user/requests']);
//            return json_encode([
//                'error' => true,
//                'errorData' => 'Description does not exist'
//            ]);
        }
    }

    public function actionEdit($id = null, $query_id = null, $car_id = null)
    {
        $post = Yii::$app->request->post();
        $product_data = $post['Product'];
        $query_data = $post['SellerQuery'];

        if ($product_data['price']) {

            $model = StoreProduct::find()->where(['id' => $product_data['product_id']])->one();

            $image = UploadedFile::getInstanceByName('mainImage');
            $dir = (__DIR__) . '/../../uploads/store-products/';

            if ($image) {
                $old_image = StoreProductImage::findOne(['main' => 1, 'product_id' => $model->id]);
                if (!empty($old_image)) $old_image->delete();
                $image_model = new StoreProductImage();
                $image_model->product_id = $model->id;
                $image_model->main = 1;
                $path = $image->baseName . '.' . $image->extension;
                if ($image->saveAs($dir . $path)) {
                    $resizer = new SimpleImage();
                    $resizer->load($dir . $path);
                    $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                    $image_name = uniqid() . '.' . $image->extension;
                    $resizer->save($dir . $image_name);
                    $image_model->link = '/uploads/store-products/' . $image_name;
                    if (file_exists($dir . $path)) unlink($dir . $path);

                    $image_model->save();

                } else {
//                    Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
//                    return $this->goBack();
                    return $this->asJson('stat','error');
                }
            }
            $images_json_array = [];
            $images = UploadedFile::getInstancesByName('Query[images]');
            if(!empty($images)) {
                foreach ($images as $key => $image) {
                    $image_model = new StoreProductImage();
                    $image_model->product_id = $model->id;
                    $image_model->main = 0;
                    $path = $image->baseName.'.'.$image->extension;
                    if($image->saveAs($dir.$path)) {
                        $resizer = new SimpleImage();
                        $resizer->load($dir.$path);
                        $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                        $image_name = uniqid().'.'.$image->extension;
                        $resizer->save($dir.$image_name);
                        $image_model->link = '/uploads/store-products/'.$image_name;
                        if(file_exists($dir.$path)) unlink($dir.$path);

                        $image_model->save();
                        $images_json_array += [$key => $image_model->link];
                    }
                    else {
                        Yii::$app->session->setFlash('error', FA::i('warning').' Ошибка, попробуйте позже.');
                        return $this->goBack();
                    }
                }

            }

            $model->save();
            $translation_en = StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'en-EN']);
            $translation_ar = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']) : new StoreProductTranslation();
            $translation_ru = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']) : new StoreProductTranslation();

            $translation_en->product_id = $model->id;
            $translation_en->name = $product_data['description'] ? mb_substr($product_data['description'], 0, 10) : '';
            $translation_en->short = $product_data['description'] ? mb_substr($product_data['description'], 0, 20) : '';
            $translation_en->description = $product_data['description'] ? $product_data['description'] : '';
            $translation_en->meta_title = $product_data['description'] ? mb_substr($product_data['description'], 0, 10) : '';
            $translation_en->meta_description = $product_data['description'] ? mb_substr($product_data['description'], 0, 20) : '';
            $translation_en->meta_keywords = $product_data['description'] ? str_replace(' ', ',', $product_data['description']) : '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->product_id = $model->id;
            $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
            $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
            $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
            $translation_ar->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ar'] : $translation_en->meta_title;
            $translation_ar->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ar'] : $translation_en->meta_description;
            $translation_ar->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ar'] : $translation_en->meta_keywords;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->product_id = $model->id;
            $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
            $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
            $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
            $translation_ru->meta_title = (Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_title']['ru'] : $translation_en->meta_title;
            $translation_ru->meta_description = (Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_description']['ru'] : $translation_en->meta_description;
            $translation_ru->meta_keywords = (Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['meta_keywords']['ru'] : $translation_en->meta_keywords;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            $price = $product_data['price'] ? $product_data['price'] : 1;
            $purchase_price = $price * (1 + ($model->user->commission->commission ? $model->user->commission->commission : 0) / 100);

            $model->price = $price;
            $model->purchase_price = $purchase_price;

            $model->save();

//                $model->title = Helper::toSlug(mb_substr($product_data['description'],0,'15')).'-' ;
//                $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;

            $seller = SellerQuery::find()->where(['seller_id' => Yii::$app->user->identity->getId(), 'query_id' => $query_data['query_id']])->with('query')->one();
            $seller->product_id = $model->id;
            $seller->status = SellerQuery::STATUS_MODERATE;
            $seller->save();

//                Yii::$app
//                    ->mailer
//                    ->compose(
//                        ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
//                        [
//                            'type' => 'buyer',
//                            'product_id' => $model->id,
//                            'query_name' => $seller->query->title,
//                            'query_date' => $seller->query->created_at,
//                            'query_car_name' => $seller->query->vendor .' '.$seller->query->car.' '.$seller->query->modification.' '.$seller->query->year
//                        ]
//                    )
//                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
//                    ->setTo($seller->query->email)
//                    ->setSubject('Added product by your request #'.$seller->query->id .' | '.Yii::$app->name)
//                    ->send();
//
//                Yii::$app
//                    ->mailer
//                    ->compose(
//                        ['html' => 'makeProduct-html', 'text' => 'makeProduct-text'],
//                        ['type' => 'admin',
//                            'product_id' => $model->id,
//                            'query_name' => $seller->query->title,
//                            'query_date' => $seller->query->created_at,
//                            'query_car_name' => $seller->query->vendor .' '.$seller->query->car.' '.$seller->query->modification.' '.$seller->query->year
//                        ]
//                    )
//                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
//                    ->setTo(Yii::$app->params['adminEmail'])
//                    ->setSubject(Yii::$app->name)
//                    ->send();

            $get_prices = SellerQuery::find()->where(['query_id' => $query_data['query_id']])->andWhere(['not', ['product_id' => null]])->all();
            $price_array = [];
            $prices = [];
            foreach ($get_prices as $get_price) {
                $price_array[] += $get_price->productPrice->price;
            }
            sort($price_array);
            $arrlength = count($price_array);
            if ($arrlength > 3) $counter = 3;
            else $counter = $arrlength;

            if ($counter > 0) {
                for ($x = 0; $x < $counter; $x++) {
                    $prices += [$x => $price_array[$x]];
                }
            } else {
                $prices = null;
            }

            return json_encode([
                'error' => false,
                'status' => 'Request sent',
                'prices' => $prices,
                'post' => $post,
                'images_json_array' => $images_json_array,
                //            'product' => [
                //                'page_title' => Yii::t('frontend', 'Product added to cart 1'),
                //                'img' => $product->image,
                //                'name' => $product->translate->name,
                //                //                        'shop' => $product->shop->name,
                //                'cat' => $product->category->translate->title,
                //                'cart_count' => static::getCount(),
                //            ],
            ]);

//            return $this->redirect(['/user/requests']);
        } else {
            return json_encode([
                'error' => true,
                'errorData' => 'Price does not exist'
            ]);
//            Yii::$app->session->setFlash('error', FA::i('warning').' Price not');
//            return $this->goBack();
//            return $this->redirect(['/user/requests']);
        }
//        return $this->redirect(['/user/requests']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $video = StoreProductVideo::findAll(['product_id' => $model->id]);

        $vendor_name = !empty(Yii::$app->request->post('vendor')) ? Yii::$app->request->post('vendor') : null;
        $car_name = !empty(Yii::$app->request->post('car')) ? Yii::$app->request->post('car') : null;
        $modification_name = !empty(Yii::$app->request->post('modification')) ? Yii::$app->request->post('modification') : null;
        $year = !empty(Yii::$app->request->post('year')) ? Yii::$app->request->post('year') : null;

//        $car_id = (!empty(Cars::find()->where(['vendor'=>$vendor_name, 'car'=>$car_name, 'modification'=>$modification_name,'year'=>$year])->one()))
//            ? Cars::find()->where(['vendor'=>$vendor_name, 'car'=>$car_name, 'modification'=>$modification_name,'year'=>$year])->one()
//            : $model->car_id;

        $car = !empty(Cars::findOne(['id' => Yii::$app->request->get('car_id')]))
            ? Cars::findOne(['id' => Yii::$app->request->get('car_id')])
            : Cars::findOne(['id' => $model->car_id]);

        $car_id = $car->id;

        if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
            if (Yii::$app->user->identity->id == $model->user_id) {

                $old_cat = $model->category_id;
                $unset_opt = false;
                $cats = StoreCategory::find()->where(['parent_id' => null, 'status' => 1])->orderBy('`order`')->all();
                $type_cars = StoreTypeCar::find()->where(['parent_id' => null])->all();

                $category = !empty(Yii::$app->request->get('category')) ? Yii::$app->request->get('category') : $old_cat;

                if (empty($category = StoreCategory::findOne(['id' => $category, 'status' => 1]))) $category = false;
                if (!empty($category)) if (!empty($category->activeCategories)) $category = false;

                $translation_en = StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'en-EN']);
                $translation_ar = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ar-AE']) : new StoreProductTranslation();
                $translation_ru = (!empty(StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']))) ? StoreProductTranslation::findOne(['product_id' => $model->id, 'locale' => 'ru-RU']) : new StoreProductTranslation();

                $cars_array = Cars::getVendors();

//                echo '<pre>';
//                print_r(Yii::$app->request->post());
//                echo '</pre>';
//                exit;

                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    if (Yii::$app->request->post('StoreProduct')['category_id'] != $old_cat) $unset_opt = true;
                    if ($model->quantity == 0) {
                        $model->status = 0;
                    }

                    $image = UploadedFile::getInstanceByName('mainImage');
                    $dir = (__DIR__) . '/../../uploads/store-products/';

                    if ($image) {
                        
                        $old_image = StoreProductImage::findOne(['main' => 1, 'product_id' => $model->id]);
                        if (!empty($old_image)) $old_image->delete();
                        $image_model = new StoreProductImage();
                        $image_model->product_id = $model->id;
                        $image_model->main = 1;
                        $path = $image->baseName . '.' . $image->extension;
                        if ($image->saveAs($dir . $path)) {
                            $resizer = new SimpleImage();
                            $resizer->load($dir . $path);
                            $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                            $image_name = uniqid() . '.' . $image->extension;
                            $resizer->save($dir . $image_name);
                            $image_model->link = '/uploads/store-products/' . $image_name;
                            if (file_exists($dir . $path)) unlink($dir . $path);

                            $image_model->save();
                        } else {
                            Yii::$app->session->setFlash('error', FA::i('warning') . ' Ошибка, попробуйте позже.');
                            return $this->goBack();
//                            return $this->asJson('stat','error');
                        }
                    }

                    $images = UploadedFile::getInstancesByName('images');
                    if(!empty($images)) {
                        foreach ($images as $image) {
                            $image_model = new StoreProductImage();
                            $image_model->product_id = $model->id;
                            $image_model->main = 0;
                            $path = $image->baseName.'.'.$image->extension;
                            if($image->saveAs($dir.$path)) {
                                $resizer = new SimpleImage();
                                $resizer->load($dir.$path);
                                $resizer->resize(Yii::$app->params['imageSizes']['store-products']['image'][0], Yii::$app->params['imageSizes']['store-products']['image'][1]);
                                $image_name = uniqid().'.'.$image->extension;
                                $resizer->save($dir.$image_name);
                                $image_model->link = '/uploads/store-products/'.$image_name;
                                if(file_exists($dir.$path)) unlink($dir.$path);

                                $image_model->save();
                            }
                            else {
                                Yii::$app->session->setFlash('error', FA::i('warning').' Ошибка, попробуйте позже.');
                                return $this->goBack();
                            }
                        }

                    }

                    $model->car_id = $car_id;
                    $model->save();

                    $translation_en->product_id = $model->id;
                    $translation_en->name = (Yii::$app->request->post('StoreProductTranslation')['name']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['en'] : '';
                    $translation_en->short = (Yii::$app->request->post('StoreProductTranslation')['short']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['en'] : '';
                    $translation_en->description = (Yii::$app->request->post('StoreProductTranslation')['description']['en'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['en'] : '';
                    $translation_en->locale = 'en-EN';
                    $translation_en->save();

                    $translation_ar->product_id = $model->id;
                    $translation_ar->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ar'] : $translation_en->name;
                    $translation_ar->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ar'] : $translation_en->short;
                    $translation_ar->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ar'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ar'] : $translation_en->description;
                    $translation_ar->locale = 'ar-AE';
                    $translation_ar->save();

                    $translation_ru->product_id = $model->id;
                    $translation_ru->name = (Yii::$app->request->post('StoreProductTranslation')['name']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['name']['ru'] : $translation_en->name;
                    $translation_ru->short = (Yii::$app->request->post('StoreProductTranslation')['short']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['short']['ru'] : $translation_en->short;
                    $translation_ru->description = (Yii::$app->request->post('StoreProductTranslation')['description']['ru'] != '') ? Yii::$app->request->post('StoreProductTranslation')['description']['ru'] : $translation_en->description;
                    $translation_ru->locale = 'ru-RU';
                    $translation_ru->save();

                    $price = $model->price ? $model->price : 1;

                    $purchase_price = $price * (1 + ($model->user->commission->commission ? $model->user->commission->commission : 0) / 100);

                    $model->purchase_price = $purchase_price;
                    $model->save();

//                    $car = Cars::find()
//                        ->where(['vendor'=>$vendor_name, 'car'=>$car_name, 'modification'=>$modification_name, 'year'=>$year])->one();

//                    $productCar = StoreProductToCar::findOne(['product_id'=>$model->id]);
//                    $productCar->product_id = $model->id;
//                    $productCar->car_id = $car->id;
//                    $productCar->save();

                    if (empty(Yii::$app->request->post('StoreProduct')['title'])) {
                        $model->title = Helper::toSlug($translation_en->name) . '_' . $model->id;
                    } else {
                        $model->title = Helper::toSlug(Yii::$app->request->post('StoreProduct')['title']) . '_' . $model->id;
                    }
                    if (empty($model->slug)) {
                        if (empty(Yii::$app->request->post('StoreProduct')['slug'])) {
                            $model->slug = Helper::toSlug($translation_en->name) . '_' . $model->id;
                        } else {
                            $model->slug = Helper::toSlug(Yii::$app->request->post('StoreProduct')['slug']) . '_' . $model->id;
                        }
                    }

                    $model->save();

//                    return $this->redirect(['update', 'id' => $model->id]);
                    return $this->redirect(['/user/requests']);
                }

                return $this->render('update', [
                    'model' => $model,
                    'video' => $video,
                    'cats' => $cats,
                    'category' => $category,
                    'translation_en' => $translation_en,
                    'translation_ar' => $translation_ar,
                    'translation_ru' => $translation_ru,
                    'type_cars' => $type_cars,
                    'car_id' => $car_id,
                ]);

            }
            return $this->goBack();
        }
        return $this->goBack();
    }

    /**
     * Finds the StoreProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSearch($vendor, $car, $modification, $category_id = null, $type_car_id = null)
    {
//        self::getCar()
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->all();
//        $cars_1 = Cars::find()->select([
//            'minId' => new Expression('MIN(cars.id)'),
//            'maxId' => new Expression('MAX(cars.id)'),
//        ])->where(['vendor' => $vendor, 'car'=>$car, 'modification'=>$modification])->all();

        $car_id_min = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->min('id');
        $car_id_max = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->max('id');


        $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['status' => 1])->all();

        if (!empty($category_id)) {
            $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['category_id' => $category_id])->andWhere(['status' => 1])->all();
        }
        if (!empty($type_car_id)) {
            $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['type_car_id' => $type_car_id])->andWhere(['status' => 1])->all();
        }
        if (!empty($category_id) && !empty($type_car_id)) {
            $products = StoreProduct::find()->where(['between', 'car_id', $car_id_min, $car_id_max])->andWhere(['category_id' => $category_id, 'type_car_id' => $type_car_id])->andWhere(['status' => 1])->all();
        }

//        return $this->asJson($products);
        return $products;
    }

    public function actionGetVendors()
    {
        $data = Cars::getVendors();

        return $data;
    }

    public function actionGetCar($vendor)
    {
        $car_vendor = $vendor;

//        $cars = Cars::find()->where(['vendor' => $car_vendor])->orderBy(['car' => SORT_ASC])->all();
        $query = new Query();
        $cars = $query->select(['car'])
            ->from('cars')
            ->where(['vendor' => $car_vendor])
            ->orderBy(['car' => SORT_ASC])
            ->distinct()
            ->all();
        $cars_array = [];

        if ($cars) {
            foreach ($cars as $key => $car) {
                $cars_array[$car['car']] = $car['car'];
            }
        }
//        return $this->asJson($cars_array);

        $data = '<option disabled selected>' . 'Select Model' . '</option>';
        if (count($cars_array)) {
            foreach ($cars_array as $key => $car_array) {
                $data .= '<option value="' . $car_array . '">' . $car_array . '</option>';
            }
        }

        return $this->asJson($data);
    }

    public function actionGetModification($vendor, $car)
    {
        $car_vendor = $vendor;

        $cars = Cars::find()->where(['vendor' => $car_vendor, 'car' => $car])->orderBy(['modification' => SORT_ASC, 'year' => SORT_DESC])->all();
        $cars_array = [];
        $years = [];
        $min_max = [];

        if (count($cars)) {
            foreach ($cars as $key => $car_1) {
                $cars_array[$car_1['modification']] = $car_1['modification'];
                $years[$car_1['modification']] = self::getYear($vendor, $car, $car_1['modification']);

                $min_max[$car_1['modification']] = [
                    'min' => $min = min($years[$car_1['modification']]),
                    'max' => $max = max($years[$car_1['modification']])
                ];
            }
        }

        $data = '<option disabled selected>' . 'Select Generation' . '</option>';
        if (count($min_max)) {
            foreach ($min_max as $key => $car_array) {
                $data .= '<option value="' . $key . '">' . $key . ' (' . $car_array['min'] . ' - ' . $car_array['max'] . ')' . '</option>';
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

    public function actionGetYear($vendor, $car, $modification)
    {
        $cars = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification])->orderBy(['year' => SORT_ASC])->all();
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

    public function getTypeCarCategoryChild($cat, $model, $index = 1)
    {
        $result = [];
        $prefix = '';
        for ($i = 0; $i < $index; $i++) {
            $prefix .= '-';
        }
        $style = false;
        if ($index == 1) $style = 'bold';
        foreach ($cat as $item) {
            if ($model->id == $item->id) continue;
            if ($style) $result[$item->id] = $prefix . $item->translate->name;
            else $result[$item->id] = $prefix . $item->translate->name;
            if ($item->typeCars) {
                $result = ArrayHelper::merge($result, self::getTypeCarCategoryChild($item->typeCars, $type_car, $index + 1));
            }
        }
        return $result;
    }

    public function actionGetOneCar($vendor, $car, $modification, $year)
    {
//        $vendor = Yii::$app->request->get('vendor');
//        $car = Yii::$app->request->get('car');
//        $modification = Yii::$app->request->get('modification');
//        $year = Yii::$app->request->get('year');

        $oneCar = Cars::find()->where(['vendor' => $vendor, 'car' => $car, 'modification' => $modification, 'year' => $year])->one();
        $id = $oneCar->id;

        return $id;
    }
}