<?php
namespace frontend\controllers;

use common\models\Page;
use common\models\StoreCategory;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        \Yii::$app->view->registerMetaTag([
            'name' => 'title',
            'content' => Yii::$app->params['appName'],
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'The Largest Online Store for Used Spare Parts in U.A.E'
        ]);

//        Schema.org разметка for Google+
        \Yii::$app->view->registerMetaTag([
            'itemprop' => 'name',
            'content' => Yii::$app->params['appName'],
        ]);

        \Yii::$app->view->registerMetaTag([
            'itemprop' => 'description',
            'content' => 'The Largest Online Store for Used Spare Parts in U.A.E',
        ]);

        \Yii::$app->view->registerMetaTag([
            'itemprop' => 'image',
            'content' => Yii::$app->urlManager->createAbsoluteUrl(['svg/goparts_logo_1.svg']),
        ]);


        \Yii::$app->view->registerMetaTag([
            'property' => 'og:title',
            'content' => Yii::$app->params['appName'],
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:type',
            'content' => 'The Largest Online Store for Used Spare Parts in U.A.E',
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:description',
            'content' => 'The Largest Online Store for Used Spare Parts in U.A.E',
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:site_name',
            'content' => Yii::$app->params['appName'],
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'content' => Yii::$app->urlManager->createAbsoluteUrl([]),
        ]);

        \Yii::$app->view->registerMetaTag([
            'property' => 'og:image',
            'content' => Yii::$app->urlManager->createAbsoluteUrl(['svg/goparts_logo_1.svg']),
        ]);

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role == 1) {
                return $this->redirect(['user/index']);
            }
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
//        print_r(Yii::$app->request->post());exit;
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email. Your profile will be activated within 24 hours');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
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

    public function actionPage($id)
    {
//        Yii::$app->session->set('root_category', false);
//        Yii::$app->session->set('page', false);
        $page = Page::findOne(['status' => 1, 'slug' => $id]);
//        print_r($page);
        if (empty($page)) return $this->redirect(['site/error']);

        return $this->render('page', [
            'page' => $page,
        ]);
    }
}
