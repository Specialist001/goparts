<?php

namespace backend\controllers;

use common\components\Helper;
use common\models\PageTranslation;
use Yii;
use common\models\Page;
use backend\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();
        $translation_en = new PageTranslation();
        $translation_ar = new PageTranslation();
        $translation_ru = new PageTranslation();

//        echo '<pre>';
//        print_r(Yii::$app->request->post());
//        echo '</pre>';
//        exit;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->user_id = Yii::$app->user->identity->getId();
            $model->change_user_id = Yii::$app->user->identity->getId();
            $model->save();

            $translation_en->page_id = $model->id;
            $translation_en->title = (Yii::$app->request->post('PageTranslation')['title']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['en']
                : '';
            $translation_en->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['en']
                : '';
            $translation_en->body = (Yii::$app->request->post('PageTranslation')['body']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['en']
                : '';
            $translation_en->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['en']
                : '';
            $translation_en->description = (Yii::$app->request->post('PageTranslation')['description']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['en']
                : '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->page_id = $model->id;
            $translation_ar->title = (Yii::$app->request->post('PageTranslation')['title']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['ar']
                : $translation_en->title;
            $translation_ar->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['ar']
                : $translation_en->description;
            $translation_ar->body = (Yii::$app->request->post('PageTranslation')['body']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['ar']
                : $translation_en->body;
            $translation_ar->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['ar']
                : $translation_en->keywords;
            $translation_ar->description = (Yii::$app->request->post('PageTranslation')['description']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['ar']
                : $translation_en->description;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->page_id = $model->id;
            $translation_ru->title = (Yii::$app->request->post('PageTranslation')['title']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['ru']
                : $translation_en->title;
            $translation_ru->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['ru']
                : $translation_en->description;
            $translation_ru->body = (Yii::$app->request->post('PageTranslation')['body']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['ru']
                : $translation_en->body;
            $translation_ru->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['ru']
                : $translation_en->keywords;
            $translation_ru->description = (Yii::$app->request->post('PageTranslation')['description']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['ru']
                : $translation_en->description;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

//            $model->slug = Helper::toSlug($translation_en->title).'_'.$model->id;
            $model->slug = (trim($model->slug) == '')? Helper::toSlug($translation_en->title):  Helper::toSlug($model->slug);
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $translation_en = PageTranslation::findOne(['page_id' => $model->id, 'locale' => 'en-EN']);
        $translation_ar = (!empty(PageTranslation::findOne(['page_id' => $model->id, 'locale' => 'ar-AE'])))? PageTranslation::findOne(['page_id' => $model->id, 'locale' => 'ar-AE']): new PageTranslation();
        $translation_ru = (!empty(PageTranslation::findOne(['page_id' => $model->id, 'locale' => 'ru-RU'])))? PageTranslation::findOne(['page_id' => $model->id, 'locale' => 'ru-RU']): new PageTranslation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->change_user_id = Yii::$app->user->identity->getId();


            $translation_en->page_id = $model->id;
            $translation_en->title = (Yii::$app->request->post('PageTranslation')['title']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['en']
                : '';
            $translation_en->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['en']
                : '';
            $translation_en->body = (Yii::$app->request->post('PageTranslation')['body']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['en']
                : '';
            $translation_en->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['en']
                : '';
            $translation_en->description = (Yii::$app->request->post('PageTranslation')['description']['en'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['en']
                : '';
            $translation_en->locale = 'en-EN';
            $translation_en->save();

            $translation_ar->page_id = $model->id;
            $translation_ar->title = (Yii::$app->request->post('PageTranslation')['title']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['ar']
                : $translation_en->title;
            $translation_ar->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['ar']
                : $translation_en->description;
            $translation_ar->body = (Yii::$app->request->post('PageTranslation')['body']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['ar']
                : $translation_en->body;
            $translation_ar->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['ar']
                : $translation_en->keywords;
            $translation_ar->description = (Yii::$app->request->post('PageTranslation')['description']['ar'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['ar']
                : $translation_en->description;
            $translation_ar->locale = 'ar-AE';
            $translation_ar->save();

            $translation_ru->page_id = $model->id;
            $translation_ru->title = (Yii::$app->request->post('PageTranslation')['title']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['title']['ru']
                : $translation_en->title;
            $translation_ru->title_short = (Yii::$app->request->post('PageTranslation')['title_short']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['title_short']['ru']
                : $translation_en->description;
            $translation_ru->body = (Yii::$app->request->post('PageTranslation')['body']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['body']['ru']
                : $translation_en->body;
            $translation_ru->keywords = (Yii::$app->request->post('PageTranslation')['keywords']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['keywords']['ru']
                : $translation_en->keywords;
            $translation_ru->description = (Yii::$app->request->post('PageTranslation')['description']['ru'] != '')
                ? Yii::$app->request->post('PageTranslation')['description']['ru']
                : $translation_en->description;
            $translation_ru->locale = 'ru-RU';
            $translation_ru->save();

            $model->slug = (trim($model->slug) == '')? Helper::toLatin($translation_en->title):  Helper::toLatin($model->slug);
            $model->save();

            Yii::$app->session->setFlash('success', 'Form Saved');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'translation_en' => $translation_en,
            'translation_ar' => $translation_ar,
            'translation_ru' => $translation_ru,
        ]);
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
