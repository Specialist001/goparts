<?php

namespace backend\controllers;

use common\models\StoreOrderProduct;
use Yii;
use common\models\StoreOrder;
use backend\models\StoreOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * StoreOrderController implements the CRUD actions for StoreOrder model.
 */
class StoreOrderController extends Controller
{
    const STATUS_NEW = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    const PAID = 1;
    const NOT_PAID = 0;

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

    /**
     * Lists all StoreOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreOrder model.
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

    public function actionSellerInvoice($id)
    {
        $order_product = StoreOrderProduct::find()->where(['id'=>$id])->with('order','product')->one();
//        $order = StoreOrder::find()->where(['product_id'=>$order_product->id])->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 15,
            'marginTop' => 15,
            'marginRight' => 10,
            'marginBottom' => 15,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('_invoiceseller.php', [
//                'order' => $order,
                'order_product' => $order_product,
            ]),
            'cssFile' => '@frontend/web/css/pdf_style.css',
            'options' => [
                'title' => 'PDF Document Title',
                'subject' => 'PDF Document Subject'
            ],
            'filename' => 'Invoice - ' . $order_product->id.' GoParts' . '.pdf',
            'methods' => [
                'SetTitle' => 'Invoice - ' . $order_product->id . ' at (' . date('d-m-Y', $order_product->order->created_at) . ')',
                'SetSubject' => 'Invoice GoParts',
                /*'SetHeader' => ['Р”РѕРіРѕРІРѕСЂ||РѕС‚: ' . $data['deal_date']],*/
//                'SetFooter' => ['|{PAGENO}|'],
                'SetAuthor' => 'GoParts',
                'SetCreator' => 'GoParts',
                'SetKeywords' => $order_product->product_name,
            ],
        ]);

        return $pdf->render();
    }

    public function actionBuyerInvoice($id)
    {
        $order_product = StoreOrderProduct::find()->where(['id'=>$id])->with('order','product')->one();
//        $order = StoreOrder::find()->where(['product_id'=>$order_product->id])->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 15,
            'marginTop' => 15,
            'marginRight' => 10,
            'marginBottom' => 15,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('_invoicebuyer.php', [
//                'order' => $order,
                'order_product' => $order_product,
            ]),
            'cssFile' => '@frontend/web/css/pdf_style.css',
            'options' => [
                'title' => 'PDF Document Title',
                'subject' => 'PDF Document Subject'
            ],
            'filename' => 'Invoice - ' . $order_product->id.' GoParts' . '.pdf',
            'methods' => [
                'SetTitle' => 'Invoice - ' . $order_product->id . ' at (' . date('d-m-Y', $order_product->order->created_at) . ')',
                'SetSubject' => 'Invoice GoParts',
                /*'SetHeader' => ['Р”РѕРіРѕРІРѕСЂ||РѕС‚: ' . $data['deal_date']],*/
//                'SetFooter' => ['|{PAGENO}|'],
                'SetAuthor' => 'GoParts',
                'SetCreator' => 'GoParts',
                'SetKeywords' => $order_product->product_name,
            ],
        ]);

        return $pdf->render();
    }

    public function actionPdf()
    {
        return $this->render('_invoice');
    }

    /**
     * Creates a new StoreOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreOrder model.
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
     * Deletes an existing StoreOrder model.
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
     * Finds the StoreOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
