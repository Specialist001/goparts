<?php
namespace backend\controllers;

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

        $users = User::find()->all();
        $counter['user_count'] = count($users);

        $products  = StoreProduct::find()->all();
        $counter['product_count'] = count($products);

        $orders = StoreOrder::find()->all();
        $counter['order_count'] = count($orders);

        return $this->render('index', [
            'counter' => $counter,
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
