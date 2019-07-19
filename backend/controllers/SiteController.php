<?php
namespace backend\controllers;

use common\models\Query;
use common\models\SellerQuery;
use common\models\StoreCategory;
use common\models\StoreOrder;
use common\models\StoreProduct;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index', 'get-cats'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'get-cats'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $counter = [];
        $latest = [];

        $users = User::find();
        $counter['new_sellers'] = $users->where(['status'=>9,'role'=>User::ROLE_SELLER])->count();
        $counter['new_shops'] = $users->where(['status'=>9,'role'=>User::ROLE_BUYER,'reg_type'=>'manual'])->count();
        $counter['new_customers'] = $users->where(['status'=>10,'role'=>User::ROLE_BUYER,'reg_type'=>'auto'])->count();

        $product  = StoreProduct::find();
        $latest['products'] = $product->orderBy('id DESC')->limit(5)->all();
        $products = $product->all();
        $counter['product_count'] = count($products);

        $orders = StoreOrder::find()->all();
        $counter['order_count'] = count($orders);

        $query = Query::find();
        $latest['queries'] = $query->orderBy('id DESC')->limit(10)->all();
        $queries = $query->all();
        $counter['query_count'] = $query->where(['status'=>Query::STATUS_MODERATED])->count();

        $request = SellerQuery::find();
        $latest['requests'] = $request->orderBy('id DESC')->limit(10)->all();
        $requests = $request->all();
        $counter['request_count'] = $request->where(['status'=>SellerQuery::STATUS_MODERATE])->count();;

        return $this->render('index', [
            'counter' => $counter,
            'latest' => $latest,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = '//main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())
            && $model->login()
            && Yii::$app->user->can('moderator')) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetCats() {
        $this->layout = 'empty';
        $id = !empty(Yii::$app->request->get('id'))? Yii::$app->request->get('id'): null;
        $add = !empty(Yii::$app->request->get('add'))? Yii::$app->request->get('add'): '';
        $cats = StoreCategory::find()->with('categories')->with('parent')->where(['parent_id' => $id, 'status' => 1])->orderBy('`order`')->all();
        return $this->render('cat-widget', [
            'cats' => $cats,
            'add' => $add
        ]);
    }


}
