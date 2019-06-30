<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SellerQuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seller Queries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seller-query-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Seller Query', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Clear Sort', ['/seller-query'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'query_id',
            [
                'attribute' => 'query_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href="'.\yii\helpers\Url::to(['query/view', 'id'=>$model->query_id]).'">'.$model->query_id.'</a>';
                }
            ],
            [
                'attribute' => 'seller_id',
                'label' => 'Seller',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->seller_id
                        ? '<a href="'.\yii\helpers\Url::to(['user/view', 'id'=>$model->seller->id]).'">'.$model->seller->username.'</a>'
                        : null;
                }
            ],
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->product_id
                        ? '<a href="'.\yii\helpers\Url::to(['store-product/view', 'id'=>$model->product_id]).'">'.$model->product->translate->name.' ID:'.$model->product_id.'</a>'
                        : null;
                }
            ],
            [
                'attribute' => 'status',
                'format' =>'sellerQuery',
                'filter' => ['0'=>'Waited','1'=>'Moderate','2'=>'Published','3'=>'Purchased']
            ],
            //'created_at',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d/m/Y', $model->created_at);
                }
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
